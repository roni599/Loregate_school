<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> /
                    Website-Link</span>
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
                            <p class="text-black font-bold">Website-Link Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm" enctype="multipart/form-data" class="py-1">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="inputName">Title</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputName" v-model="form.title" type="text"
                                            placeholder="Enter your name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAddress">Link</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputAddress" v-model="form.link" type="text"
                                            placeholder="Address" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Edit Website-Link</span>
                                        <span v-if="loading">Editing Website-Link...</span>
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
import Weblink from './Weblink.vue';
export default {
    components:{
        Weblink
    },
    setup() {
        const loading = ref(false);
        const currentComponent = shallowRef(null);
        const form = reactive({
            title: '',
            link: ''
        });

        const componentLoad = () => {
            currentComponent.value = markRaw(Weblink)
        }
        const anotherLoad = () => {
            currentComponent.value = null
        }

        const submitForm = async () => {
            loading.value = true;

            try {
                const formData = new FormData();
                formData.append('title', form.title);
                formData.append('link', form.link);
                const response = await axios.post('/api/academy/websitelink', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                if (response.data) {
                    resetForm();
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.log(error)
                Swal.fire({
                    icon: 'error',
                    title: error.response?.data?.message || 'An error occurred',
                });
            } finally {
                loading.value = false;
            }
        };
        const resetForm = () => {
            form.title = '';
            form.link = '';
        };

        return {
            form,
            loading,
            submitForm,
            resetForm,
            componentLoad,
            anotherLoad,
            currentComponent
        }
    }
}
</script>

<style></style>