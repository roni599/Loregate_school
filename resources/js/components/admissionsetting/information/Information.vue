<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / Admission-Information</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-1">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Admission Assign Create</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="classDetails" class="form-label mb-0">Class Details</label>
                                        <!-- <select class="form-select" v-model="form.class_id">
                                            <option selected>Open this select menu</option>
                                            <option v-for="classItem in classes" :key="classItem.id"
                                                :value="classItem.id">
                                                {{ classItem.class_name }}
                                                <span v-if="classItem.class_name != null">></span>
                                                {{ classItem.shift }} <span v-if="classItem.shift != null">></span>{{
                                                    classItem.section }}
                                                <span v-if="classItem.section != null">></span>{{ classItem.group
                                                }}<span v-if="classItem.group != null">></span>{{ classItem.session }}
                                            </option>
                                        </select> -->
                                        <select class="form-select" v-model="form.class_id">
                                            <option selected>Open this select menu</option>
                                            <option v-for="classItem in classes" :key="classItem.id"
                                                :value="classItem.id">
                                                {{ classItem.class_details.split('>').filter(part => part !==
                                                    'null').join('>') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="termscondition" class="mb-1">Information</label>
                                    <input type="date" v-model="form.date" class="form-control mb-3">
                                </div>
                            </div> -->
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="termscondition" class="mb-1">Information</label>
                                    <textarea v-model="form.information" class="form-control mb-3" rows="5"
                                        placeholder="Add Education Name"></textarea>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-primary w-100">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';

export default {
    name: "Information",
    setup() {
        const classes = ref([]);
        const form = ref({
            class_id: '',
            information: '',
            // date: ''
        })
        const submitForm = async () => {
            const formData = new FormData();
            formData.append('class_id', form.value.class_id);
            formData.append('information', form.value.information);
            // formData.append('date', form.value.date);
            try {
                const response = await axios.post('/api/class-information/store', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                if (response.data && response.data.message) {
                    resetForm();
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.error('Error submitting form:', error);
            }
        }
        const fetchData = async () => {
            try {
                const response = await axios.get(`/api/admissionassign`);
                if (response.data && response.data.message) {
                    classes.value = response.data.data;
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };
        const resetForm = () => {
            form.value.class_id = '',
                form.value.information = '',
                form.value.date = ''
        }
        onMounted(() => {
            fetchData()
        })
        return {
            classes,
            fetchData,
            form,
            submitForm,
            resetForm
        }
    }
}
</script>

<style></style>