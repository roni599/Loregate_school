<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / Student-information</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="buttonalign d-flex justify-content-md-start justify-content-center gap-2">
                <div>
                    <button @click="componentLoad('AdmissionassignformType')" class="btn btn-info px-5">Form Name
                        Assign</button>
                </div>
                <div>
                    <button @click="anotherLoad" class="btn btn-info px-5">Stuedent Information Field Create</button>
                </div>
                <div>
                    <button @click="componentLoad('StudentinformationList')" class="btn btn-info px-5">List</button>
                </div>
            </div>
        </div>
        <div v-show="!currentComponent" class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Personal Information</h5>
                    </div>
                    <div class="card-body mb-3">
                        <form @submit.prevent="submitForm">
                            <div class="form-group mb-3">

                                <label for="field_type">Form Name</label>
                                <select id="field_type" class="form-control p-3 mb-4" v-model="field.formname">
                                    <option v-for="formname in Formnames" :key="formname.id" :value="formname.id">{{
                                        formname.name }}</option>
                                </select>
                                <label for="field_name">Field Name</label>
                                <input v-model="field.field_name" id="field_name" type="text"
                                    class="form-control mb-2 p-3" placeholder="Enter Field Name" required />

                                <label for="field_type">Field Type</label>
                                <select v-model="field.field_type" id="field_type" class="form-control p-3 mb-4">
                                    <option value="text">text</option>
                                    <option value="password">password</option>
                                    <option value="email">email</option>
                                    <option value="select">select</option>
                                    <option value="date">date</option>
                                    <option value="textarea">textarea</option>
                                    <option value="file">file</option>
                                    <option value="button">button</option>
                                    <option value="number">number</option>
                                    <option value="radio">radio</option>
                                    <option value="checkbox">checkbox</option>
                                </select>

                                <div v-if="field.field_type === 'select'" class="form-group mb-4">
                                    <label for="options">Options (comma separated)</label>
                                    <input v-model="field.options" type="text" class="form-control mb-3 p-3"
                                        placeholder="e.g., Option 1, Option 2, Option 3" />
                                </div>

                                <div class="form-check mb-4">
                                    <input v-model="field.required" id="required" type="checkbox"
                                        class="form-check-input" />
                                    <label for="required" class="form-check-label">Required Field</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Submit Field</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <component :is="currentComponent"></component>
</template>
<script>
import { ref, reactive, shallowRef, markRaw, watch, onMounted } from 'vue';
import axios from 'axios';
import StudentinformationList from './StudentinformationList.vue';
import AdmissionassignformType from './AdmissionassignformType.vue';
export default {
    setup() {
        const components = {
            StudentinformationList: markRaw(StudentinformationList),
            AdmissionassignformType: markRaw(AdmissionassignformType),
        };

        const currentComponent = shallowRef(null);
        const Formnames = ref([]);
        const field = ref({
            field_name: '',
            field_type: '',
            options: '',
            formname: '',
            required: false
        });

        const componentLoad = (componentName) => {
            currentComponent.value = components[componentName];
        }
        const anotherLoad = () => {
            currentComponent.value = null
        }
        const submitForm = async () => {
            const formData = {
                field_name: field.value.field_name,
                field_type: field.value.field_type,
                formname: field.value.formname,
                options: field.value.options ? field.value.options.split(',') : [],
                required: field.value.required
            };

            try {
                const response = await axios.post('/api/fields/store', formData);
                if (response.data && response.data.message) {
                    resetForm();
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.error('Error saving field:', error);
            }
        };
        const resetForm = () => {
            field.value.field_name = '';
            field.value.field_type = '';
            field.value.options = '';
            field.value.required = false;
            field.value.formname = ''
        }

        const fetchForm = async () => {
            try {
                const response = await axios.get(`/api/form-names`);
                if (response.data && response.data.message) {
                    Formnames.value = response.data.data
                }
            } catch (error) {

            }
        }

        onMounted(() => {
            fetchForm()
        })

        return {
            field,
            submitForm,
            resetForm,
            currentComponent,
            anotherLoad,
            componentLoad,
            fetchForm,
            Formnames
        };
    }
};

</script>