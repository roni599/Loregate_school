<template>
    <div class="container-fluid">
        <div class="card mt-3 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5"
                    to="/admin-dashboard">Dashboard</router-link><span class="text-muted h5"> / Header</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-1">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-2">
                            <p><i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Header Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm" enctype="multipart/form-data" class="">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="inputName">Academy Name</label>
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input v-model="form.academy_name" class="form-control" id="inputName"
                                            type="text" placeholder="Enter your name" />
                                        <small class="text-danger" v-if="errors.academy_name">{{
                                            errors.academy_name[0]
                                            }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="inputAddress">Academy Address</label>
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input class="form-control" v-model="form.academy_address" id="inputAddress"
                                            type="text" placeholder="Address" />
                                        <small class="text-danger" v-if="errors.academy_address">{{
                                            errors.academy_address[0]
                                            }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="inputSalary">Academy Mobile Number</label>
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input v-model="form.academy_mobile_number" class="form-control"
                                            id="inputSalary" type="text" placeholder="Salary" />
                                        <small class="text-danger" v-if="errors.academy_mobile_number">{{
                                            errors.academy_mobile_number[0] }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-11 mb-3">
                                    <label for="inputSalary">Academy Logo</label>
                                    <div class="form-floating mb-2 mb-md-0">
                                        <input ref="fileInput" @change="onFileSelect" class="form-control p-3 px-4"
                                            id="inputFile" type="file" />
                                        <small class="text-danger" v-if="errors.academy_logo">{{
                                            errors.academy_logo[0]
                                            }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1 mt-4">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <img :src="form.academy_logo" width="55" height="55" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Edit Header</span>
                                        <span v-if="loading">Editing Header...</span>
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
import axios from "axios";
import { onMounted, ref } from "vue";
export default {
    name: "Header",
    data() {
        const form = ref({
            academy_name: "",
            academy_address: "",
            academy_mobile_number: "",
            academy_logo: null,
        });
        const loading = ref(false);
        const fileInput = ref(null);
        const errors = ref({});

        const onFileSelect = (event) => {
            const file = event.target.files[0];
            if (file.size > 1048576) {
                Swal.fire({
                    icon: "warning",
                    title: "Image must be less than 1 MB!",
                });
            } else {
                let reader = new FileReader();
                reader.onload = (e) => {
                    form.value.academy_logo = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const submitForm = async () => {
            loading.value = true;
            const formData = new FormData();
            formData.append("academy_name", form.value.academy_name);
            formData.append("academy_address", form.value.academy_address);
            formData.append(
                "academy_mobile_number",
                form.value.academy_mobile_number
            );

            if (form.value.academy_logo) {
                formData.append("academy_logo", form.value.academy_logo);
            }
            const url = "/api/academy/header/store-update";

            axios
                .post(url, formData, {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                })
                .then((response) => {
                    console.log(response);
                    Swal.fire({
                        icon: "success",
                        title: response.data.message,
                    });
                    retriveData();
                    resetForm();
                })
                .catch((error) => {
                    errors.value = error.response.data.errors;
                })
                .finally(() => {
                    loading.value = false;
                });
        };

        const retriveData = async () => {
            try {
                const response = await axios.get("/api/academy/header");
                const data = response.data.data;

                document.title = data.academy_name || "Loregate school and college";
                const faviconElement = document.getElementById("dynamic-favicon");
                if (data.academy_logo && faviconElement) {
                    faviconElement.href = `/backend/images/academy/${data.academy_logo}`;
                }

                const academyNameElement = document.getElementById("academyname");
                if (academyNameElement) {
                    academyNameElement.textContent = data.academy_name || "Loregate school and college";
                }

                form.value.academy_name = data.academy_name;
                form.value.academy_address = data.academy_address;
                form.value.academy_mobile_number = data.academy_mobile_number;
                form.value.academy_logo = data.academy_logo;
                const imagePath = `/backend/images/academy/${data.academy_logo}`;
                const imageResponse = await fetch(imagePath);
                const imageBlob = await imageResponse.blob();
                const reader = new FileReader();

                reader.onloadend = () => {
                    form.value.academy_logo = reader.result;
                };
                reader.readAsDataURL(imageBlob);
            } catch (error) {
                console.error("Error retrieving data:", error);
            }
        };

        const resetForm = () => {
            form.value.academy_name = "";
            form.value.academy_address = "";
            form.value.academy_mobile_number = "";
            form.value.academy_logo = null;
        };

        onMounted(() => {
            retriveData();
        });

        return {
            form,
            loading,
            submitForm,
            onFileSelect,
            fileInput,
            retriveData,
            errors,
        };
    },
};
</script>

<style></style>