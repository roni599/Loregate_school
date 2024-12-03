<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5"
                    to="/admin-dashboard">Dashboard</router-link><span class="text-muted h5"> /
                    Education-Board</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="buttonalign d-flex justify-content-md-start justify-content-center gap-2">
                <div>
                    <button @click="componentLoad" class="btn btn-info px-5">List</button>
                </div>
                <div>
                    <button @click="anotherLoad" class="btn btn-info px-5">Create Class</button>
                </div>
            </div>
        </div>
        <div v-show="!currentComponent" class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-1">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Magazine Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm">
                            <div class="mb-3">
                                <label for="className" class="form-label">Class Name</label>
                                <input type="text" class="form-control" id="className" v-model="form.class_name"
                                    placeholder="Enter Class Name">
                            </div>
                            <div class="mb-3">
                                <label for="group" class="form-label">Group</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="groupCheckbox"
                                        v-model="showFields.group">
                                    <label class="form-check-label" for="groupCheckbox">Enable Group</label>
                                </div>
                                <input type="text" class="form-control" id="group" v-model="form.group"
                                    v-if="showFields.group" placeholder="Enter Group">
                            </div>
                            <div class="mb-3">
                                <label for="session" class="form-label">Session</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="sessionCheckbox"
                                        v-model="showFields.session">
                                    <label class="form-check-label" for="sessionCheckbox">Enable Session</label>
                                </div>
                                <input type="text" class="form-control" id="session" v-model="form.session"
                                    v-if="showFields.session" placeholder="Enter Session">
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="shiftCheckbox"
                                        v-model="showFields.shift">
                                    <label class="form-check-label" for="shiftCheckbox">Enable Shift</label>
                                </div>
                                <input type="text" class="form-control" id="shift" v-model="form.shift"
                                    v-if="showFields.shift" placeholder="Enter Shift">
                            </div>
                            <div class="mb-3">
                                <label for="secession" class="form-label">Section</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="secessionCheckbox"
                                        v-model="showFields.section">
                                    <label class="form-check-label" for="secessionCheckbox">Enable Section</label>
                                </div>
                                <input type="text" class="form-control" id="secession" v-model="form.section"
                                    v-if="showFields.section" placeholder="Enter Section">
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                        value="active" v-model="form.status">
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                        value="inactive" v-model="form.status">
                                    <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Edit Managing-Community</span>
                                        <span v-if="loading">Editing Managing-Community...</span>
                                    </button>
                                </div>
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
import axios from 'axios';
import AdmissionclassList from './AdmissionclassList.vue';
import { ref, reactive, shallowRef, markRaw } from 'vue';
export default {
    name: "AdmissionClass",
    setup() {
        const form = reactive({
            class_name: '',
            group: '',
            session: '',
            shift: '',
            section: '',
            status: ''
        });

        const showFields = reactive({
            group: false,
            session: false,
            shift: false,
            section: false
        });


        const currentComponent = shallowRef(null);
        const loading = ref(false);
        const componentLoad = () => {
            currentComponent.value = markRaw(AdmissionclassList)
        }
        const anotherLoad = () => {
            currentComponent.value = null
        }

        const submitForm = async () => {
            loading.value = true;
            try {
                const response = await axios.post(`/api/classes/store`, form)
                resetForm();
                if (response.data && response.data.message) {
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                }
            } catch (error) {

            } finally {
                loading.value = false;
            }
        };

        const resetForm = () => {
            Object.keys(form).forEach((key) => {
                form[key] = '';
            });
            Object.keys(showFields).forEach((key) => {
                showFields[key] = false;
            });
        };

        return {
            currentComponent,
            componentLoad,
            anotherLoad,
            loading,
            form,
            submitForm,
            showFields,
            resetForm
        }
    }
}
</script>

<style></style>