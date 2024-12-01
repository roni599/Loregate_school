<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> /
                    Teacher-Gallery</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="buttonalign d-flex justify-content-md-start justify-content-center gap-2">
                <div>
                    <button @click="componentLoad" class="btn btn-info px-5">List</button>
                </div>
                <div>
                    <button @click="anotherLoad" class="btn btn-info px-5">Create</button>
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
                        <form @submit.prevent="submitForm" enctype="multipart/form-data">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="inputName">Teacher Name</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputName" v-model="form.name" type="text"
                                            placeholder="Enter your name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputDesignation">Designation</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputDesignation" v-model="form.designation"
                                            type="text" placeholder="Enter designation" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="inputMobile">Mobile</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputMobile" v-model="form.mobile" type="text"
                                            placeholder="Enter mobile number" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail">Email</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputEmail" v-model="form.email" type="email"
                                            placeholder="Enter email" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="inputReligion">Religion</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control p-3 px-4" type="text" id="inputReligion"
                                            v-model="form.religion" />
                                    </div>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <label for="inputFile">Teacher Picture</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control p-3 px-4" type="file" @change="onFileSelect" />
                                    </div>
                                </div>
                                <div class="col-md-1 mt-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <img :src="imagePreview" v-if="imagePreview" width="55" height="55" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Edit Teacher-Gallery</span>
                                        <span v-if="loading">Editing Teacher-Gallery...</span>
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
import { ref, reactive, shallowRef, markRaw } from 'vue';
import axios from 'axios';
import TeachergalleryList from './TeachergalleryList.vue';
export default {
    name: "TeacherGallery",
    components: {
        TeachergalleryList
    },
    setup() {
        const loading = ref(false);
        const imagePreview = ref(null);
        const currentComponent = shallowRef(null);
        const form = ref({
            name: '',
            designation: '',
            mobile: '',
            email: '',
            religion: '',
            image: null,
        });

        const componentLoad = () => {
            currentComponent.value = markRaw(TeachergalleryList)
        }
        const anotherLoad = () => {
            currentComponent.value = null
        }


        const onFileSelect = (event) => {
            const file = event.target.files[0];
            if (file.size > 1048576) {
                alert("Image must be less than 1 MB!");
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.value = e.target.result;
                    form.value.image = e.target.result; // Store the image as base64
                };
                reader.readAsDataURL(file);
            }
        };

        const submitForm = async () => {
            loading.value = true;
            const formData = new FormData();
            formData.append('name', form.value.name);
            formData.append('designation', form.value.designation);
            formData.append('mobile', form.value.mobile);
            formData.append('email', form.value.email);
            formData.append('religion', form.value.religion);
            if (form.value.image) formData.append('image', form.value.image);
            try {
                const response = await axios.post('/api/academy/teacher-gallery', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                if (response.data) {
                    resetForm()
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: "error",
                    title: error.response?.data?.message || "An error occurred",
                });
            } finally {
                loading.value = false;
            }
        };
        const resetForm = () => {
            form.value = {
                name: '',
                designation: '',
                mobile: '',
                email: '',
                religion: '',
                image: null,
            };
        };
        return {
            form,
            loading,
            onFileSelect,
            submitForm,
            imagePreview,
            resetForm,
            componentLoad,
            anotherLoad,
            currentComponent
        };
    }
}
</script>

<style></style>