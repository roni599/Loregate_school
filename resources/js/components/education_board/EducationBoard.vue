<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> /
                    Education-Board</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Left-Picture Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md-4 mb-4">
                                    <label for="inputName">Education Minister Name</label>
                                    <input v-model="form.education_minister_name" type="text"
                                        class="form-control p-3 px-4" />
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="inputDesignation">Education Minister Designation</label>
                                    <input v-model="form.education_minister_designation" type="text"
                                        class="form-control p-3 px-4" />
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="inputFile">Education Minister Image</label>
                                    <input @change="onFileSelect($event, 'eminister_image')" type="file"
                                        class="form-control p-3 px-4" />
                                </div>
                                <div class="col-md-1 mt-4">
                                    <img :src="form.education_minister_image" width="55" height="55"
                                        v-if="form.education_minister_image" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 mb-4">
                                    <label for="inputName">Board Chairman Name</label>
                                    <input v-model="form.board_chairman_name" type="text"
                                        class="form-control p-3 px-4" />
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="inputDesignation">Board Chairman Designation</label>
                                    <input v-model="form.board_chairman_designation" type="text"
                                        class="form-control p-3 px-4" />
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="inputFile">Board Chairman Image</label>
                                    <input @change="onFileSelect($event, 'bchairman_image')" type="file"
                                        class="form-control p-3 px-4" />
                                </div>
                                <div class="col-md-1 mt-4">
                                    <img :src="form.board_chairman_image" width="55" height="55"
                                        v-if="form.board_chairman_image" />
                                </div>
                            </div>

                            <div class="mt-3 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Update Education-Board</span>
                                        <span v-if="loading">Updating Education-Board...</span>
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
import axios from 'axios';
import { onMounted, ref } from 'vue';
export default {
    name: "EducationBoard",
    setup() {
        const loading = ref(false);

        const form = ref({
            education_minister_name: "",
            education_minister_designation: "",
            education_minister_image: null,
            board_chairman_name: "",
            board_chairman_designation: "",
            board_chairman_image: null,
        });
        const academy_id = ref(1);
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
                    if (imageType === 'eminister_image') {
                        form.value.education_minister_image = e.target.result;
                    } else if (imageType === 'bchairman_image') {
                        form.value.board_chairman_image = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        };

        // const submitForm = async () => {
        //     loading.value = true;
        //     const formData = new FormData();
        //     formData.append("education_minister_name", form.value.education_minister_name);
        //     formData.append("education_minister_designation", form.value.education_minister_designation);
        //     formData.append("education_minister_image", form.value.education_minister_image);
        //     formData.append("board_chairman_name", form.value.board_chairman_name);
        //     formData.append("board_chairman_designation", form.value.board_chairman_designation);
        //     formData.append("board_chairman_image", form.value.board_chairman_image);

        //     try {
        //         const response = await axios.post("/api/academy/education-board", formData, {
        //             headers: { "Content-Type": "multipart/form-data" },
        //         });
        //         if (response.data) {
        //             findData()
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: response.data.message,
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

        function resetForm() {
            form.value.education_minister_name = "";
            form.value.education_minister_designation = "";
            form.value.education_minister_image = null;
            form.value.board_chairman_name = "";
            form.value.board_chairman_designation = "";
            form.value.board_chairman_image = null;
        }

        const findData = async () => {
            const response = await axios.get(`/api/academy/education-board`)
            form.value.education_minister_name = response.data.data.eminister_name;
            form.value.education_minister_designation = response.data.data.edesignation;
            form.value.board_chairman_name = response.data.data.bminister_name;
            form.value.board_chairman_designation = response.data.data.bdesignation
            form.value.education_minister_image = response.data.data.e_image;
            form.value.board_chairman_image = response.data.data.b_image;

            Object.keys(form.value).forEach(async (key) => {
                if (key === 'education_minister_image' || key === 'board_chairman_image') {
                    const imagePath = `/backend/images/educationboard/${form.value[key]}`;
                    try {
                        const imageResponse = await fetch(imagePath);
                        const imageBlob = await imageResponse.blob();
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            form.value[key] = reader.result;
                        };
                        reader.readAsDataURL(imageBlob);
                    } catch (error) {
                        console.error(`Error fetching image for ${key}:`, error);
                    }
                }
            });
        }

        const submitForm = async () => {
            loading.value = true;
            const formData = new FormData();
            formData.append("education_minister_name", form.value.education_minister_name);
            formData.append("education_minister_designation", form.value.education_minister_designation);
            formData.append("education_minister_image", form.value.education_minister_image);
            formData.append("board_chairman_name", form.value.board_chairman_name);
            formData.append("board_chairman_designation", form.value.board_chairman_designation);
            formData.append("board_chairman_image", form.value.board_chairman_image);
            try {
                const response = await axios.post('/api/academy/education-board/store-update', formData, {
                    headers: { "Content-Type": "multipart/form-data" },
                })
                if (response.data) {
                    findData()
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.log(error)
            } finally {
                loading.value = false
            }
        }
        onMounted(() => {
            findData()
        })
        return {
            loading,
            form,
            submitForm,
            onFileSelect,
            resetForm,
            findData
        }
    }
}
</script>

<style></style>