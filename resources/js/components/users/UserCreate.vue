<template>
    <div class="container">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / User-Create</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="buttonalign d-flex justify-content-md-start justify-content-center gap-2">
                <div>
                    <button @click="componentLoad" class="btn btn-info px-5">Users List</button>
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
                        <div class="icon_text d-flex gap-2">
                            <p><i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">User Create</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="userCreate" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputName" type="text"
                                            placeholder="Enter your name" v-model="form.name" />
                                        <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                        <label for="inputName">Full Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputEmail" type="email"
                                            placeholder="name@example.com" v-model="form.email" />
                                        <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputSalary" type="text" placeholder="Salary"
                                            v-model="form.password" />
                                        <small class="text-danger" v-if="errors.password">{{ errors.password[0]
                                            }}</small>
                                        <label for="inputSalary">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputPasswordConfirm" type="password"
                                            placeholder="Confirm password" v-model="form.password_confirmation" />
                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-11">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control p-3 px-4" id="inputFile" type="file"
                                            @change="onFileSelect" />
                                        <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <img :src="form.image" width="55" height="55" />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Login</span>
                                        <span v-if="loading">Logging in...</span>
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
import { ref, reactive, shallowRef, markRaw, onMounted } from "vue";
import axios from "axios";
import AllUsers from "./AllUsers.vue";

export default {
    name: "CreateUser",
    components: {
        AllUsers,
    },
    setup() {
        const form = ref({
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            image: null,
        });

        const currentComponent = shallowRef(null);
        const errors = reactive({});
        const loading = ref(false);
        const convertImageToBase64 = async (imagePath) => {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.crossOrigin = "Anonymous";
                img.src = imagePath;

                img.onload = () => {
                    const canvas = document.createElement("canvas");
                    canvas.width = img.width;
                    canvas.height = img.height;
                    const ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0, 0);
                    const base64String = canvas.toDataURL("image/jpeg");
                    resolve(base64String);
                };

                img.onerror = (err) => reject(err);
            });
        };
        onMounted(async () => {
            try {
                const base64 = await convertImageToBase64("/backend/assets/img/school1.jpg");
                form.value.image = base64;
            } catch (error) {
                console.error("Error converting image to Base64:", error);
            }
        });

        const componentLoad = () => {
            currentComponent.value = markRaw(AllUsers);
        };

        const anotherLoad = () => {
            currentComponent.value = null;
        };

        const onFileSelect = (event) => {
            const file = event.target.files[0];
            if (file) {
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
            }
        };

        const userCreate = async () => {
            loading.value = true;

            try {
                const response = await axios.post("/api/auth/signup", form.value);
                const base64 = await convertImageToBase64("/backend/assets/img/school1.jpg");
                form.value = {
                    name: "",
                    email: "",
                    password: "",
                    password_confirmation: "",
                    image: base64,
                };
                const fileInput = document.getElementById("inputFile");
                if (fileInput) {
                    fileInput.value = "";
                }
                Toast.fire({
                    icon: "success",
                    title: response.data.message,
                });
            } catch (error) {
                Object.assign(errors, error.response.data.errors || {});
            } finally {
                loading.value = false;
            }
        };
        return {
            form,
            errors,
            loading,
            onFileSelect,
            userCreate,
            componentLoad,
            currentComponent,
            anotherLoad,
        };
    },
};
</script>
