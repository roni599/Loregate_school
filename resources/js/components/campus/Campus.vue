<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5"
                    to="/admin-dashboard">Dashboard</router-link><span class="text-muted h5"> / Campus</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Campus Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm" enctype="multipart/form-data" class="py-2">
                            <div class="row mb-3">
                                <div class="col-md-11">
                                    <label for="picture1">Campus Picture1</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control p-3 px-4" id="picture1" type="file"
                                            @change="onFileSelect($event, 'picture1')" />
                                    </div>
                                </div>
                                <div class="col-md-1 mt-4">
                                    <img :src="preview1" v-if="preview1" width="55" height="55" />
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-11">
                                    <label for="picture2">Campus Picture2</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control p-3 px-4" id="picture2" type="file"
                                            @change="onFileSelect($event, 'picture2')" />
                                    </div>
                                </div>
                                <div class="col-md-1 mt-4">
                                    <img :src="preview2" v-if="preview2" width="55" height="55" />
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Edit Campus</span>
                                        <span v-if="loading">Editing campus...</span>
                                    </button>
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
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const form = reactive({
            picture1: null,
            picture2: null,
        });
        const preview1 = ref(null);
        const preview2 = ref(null);
        const loading = ref(false);
        const campusPicture_id = ref(null);

        const onFileSelect = (event, imageType) => {
            const file = event.target.files[0];
            if (file && file.size > 1048576) {
                Toast.fire({
                    icon: "warning",
                    title: "Image must be less than 1 MB!",
                });
            } else if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (imageType === 'picture1') {
                        form.picture1 = e.target.result;
                        preview1.value = e.target.result;
                    } else if (imageType === 'picture2') {
                        form.picture2 = e.target.result;
                        preview2.value = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        };

        const submitForm = async () => {
            loading.value = true;
            const formData = new FormData();
            formData.append('picture1', form.picture1);
            formData.append('picture2', form.picture2);
            try {
                const response = await axios.post('/api/campus/picture/store-update', formData, {
                    headers: { 'Content-Type': 'multipart/form-data' },
                });
                if (response.data) {
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
            } catch (error) {
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to upload images',
                });
            } finally {
                loading.value = false;
            }
        };

        // const submitForm=async()=>{
        //     loading.value = true;
        //     const formData = new FormData();
        //     formData.append('picture1', form.picture1);
        //     formData.append('picture2', form.picture2);
        //     formData.append('campusPicture_id',campusPicture_id.value);

        //     try {
        //         const response = await axios.post('/api/campus/picture/update', formData, {
        //             headers: { 'Content-Type': 'multipart/form-data' },
        //         });
        //         console.log(response)
        //     } catch (error) {
        //         Toast.fire({
        //             icon: 'error',
        //             title: 'Failed to upload images',
        //         });
        //     } finally {
        //         loading.value = false;
        //     }

        // }

        const findData = async () => {
            const response = await axios.get(`/api/campus/pictureindex`)
            // console.log(response.data.id)
            campusPicture_id.value = response.data.data.id;
            form.picture1 = response.data.data.picture1;
            form.picture2 = response.data.data.picture2;
            preview1.value = `/backend/images/campus/${response.data.data.picture1}`;
            preview2.value = `/backend/images/campus/${response.data.data.picture2}`;
            Object.keys(form).forEach(async (key) => {
                // console.log(`${key}: ${form[key]}`);
                if (key === 'picture1' || key === 'picture2') {
                    const imagePath = `/backend/images/campus/${form[key]}`;
                    try {
                        const imageResponse = await fetch(imagePath);
                        const imageBlob = await imageResponse.blob();
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            form[key] = reader.result;
                        };
                        reader.readAsDataURL(imageBlob);
                    } catch (error) {
                        console.error(`Error fetching image for ${key}:`, error);
                    }
                }
            });
            // if (response.data.pictures && response.data.pictures.length) {
            //     for (let i = 0; i < response.data.pictures.length; i++) {
            //         const picturePath = `/backend/images/slidepicture/${response.data.pictures[i]}`;
            //         const imageResponse = await fetch(picturePath);
            //         const imageBlob = await imageResponse.blob();
            //         const reader = new FileReader();
            //         reader.onloadend = () => {
            //             images[i] = { preview: reader.result };
            //             form.images[i] = reader.result;
            //         };
            //         reader.readAsDataURL(imageBlob);
            //     }
            // }
        }

        onMounted(() => {
            findData();
        })

        return {
            form,
            preview1,
            preview2,
            loading,
            onFileSelect,
            submitForm,
            findData,
            campusPicture_id
            // updateCampus
        };
    },
};
</script>


<style></style>