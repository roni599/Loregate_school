<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> /
                    Right-Picture</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Right-Picture Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm" enctype="multipart/form-data">
                            <div class="row mb-2">
                                <div class="col-md-11 mb-2">
                                    <label for="inputName">Name</label>
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input v-model="form.name" class="form-control p-3 px-4" id="inputName"
                                            type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-11 mb-2">
                                    <label for="inputDesignation">Designation</label>
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input v-model="form.designation" class="form-control p-3 px-4"
                                            id="inputDesignation" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-11 mb-2">
                                    <label for="inputFile">Upload Picture</label>
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input @change="onFileSelect" class="form-control p-3 px-4" id="inputFile"
                                            type="file" />
                                    </div>
                                </div>
                                <div class="col-md-1 mt-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <img :src="form.image" v-if="form.image"
                                            width="55" height="55" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Update Right-Picture</span>
                                        <span v-if="loading">Updating Right-Picture...</span>
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
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';
export default {
    name: "RightPicture",
    setup() {
        const loading = ref(false);
        const academy_id = ref(1);
        const form = ref({
            name: '',
            designation: '',
            image: null,
        });
        const onFileSelect = (event) => {
            const file = event.target.files[0];
            if (file.size > 1048576) {
                Toast.fire({
                    icon: "warning",
                    title: "Image must be less than 1 MB!",
                });
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    form.value.image = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        // const submitForm = async () => {
        //     loading.value = true;

        //     const formData = new FormData();
        //     formData.append('name', form.value.name);
        //     formData.append('designation', form.value.designation);
        //     formData.append('image', form.value.image);
        //     try {
        //         const response = await axios.post('/api/academy/rightpicture', formData, {
        //             headers: {
        //                 'Content-Type': 'multipart/form-data',
        //             },
        //         });
        //         if (response) {
        //             resetForm();
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: response.data,
        //             });
        //         }
        //     } catch (error) {
        //         console.error(error);
        //         Swal.fire({
        //             icon: 'error',
        //             title: error.response?.data?.message || 'An error occurred',
        //         });
        //     } finally {
        //         loading.value = false;
        //     }
        // };
        const resetForm = () => {
            form.name = ''
            form.designation = ''
            form.image = ''
        };


        const submitForm = async () => {
            loading.value = true;
            const formData = new FormData();
            formData.append("name", form.value.name);
            formData.append("designation", form.value.designation);
            formData.append("image", form.value.image);
            try {
                const response = await axios.post('/api/academy/rightpicture/store-update',
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                )
                console.log(response)
                if (response.data) {
                    findrightPicture()
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                }
            }
            catch (error) {
                console.error(error);
                Swal.fire({
                    icon: "error",
                    title: error.response?.data?.message || "An error occurred",
                });
            } finally {
                loading.value = false;
            }
        }

        const findrightPicture = async () => {
            try {
                const response = await axios.get(
                    `/api/academy/rightpicture`
                );
                form.value.name = response.data.data.name;
                form.value.designation = response.data.data.designation;
                form.value.image = response.data.data.image;
                const picturePath = `/backend/images/rightpicture/${form.value.image}`;
                const imageResponse = await fetch(picturePath);
                if (imageResponse.ok) {
                    const imageBlob = await imageResponse.blob();
                    const reader = new FileReader();
                    reader.onloadend = () => {
                        form.value.image = reader.result;
                    };
                    reader.readAsDataURL(imageBlob);
                } else {
                    console.error("Image fetch failed:", imageResponse.statusText);
                }
            } catch (error) { }
        };

        onMounted(() => {
            findrightPicture();
        });

        return {
            form,
            loading,
            onFileSelect,
            submitForm,
            resetForm,
            findrightPicture,
            academy_id
        }
    }
}
</script>

<style></style>