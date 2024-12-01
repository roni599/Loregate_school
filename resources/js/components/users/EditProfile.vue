<template>
    <div class="container">
        <div class="card mt-4 mb-4">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / Edit-Profile</span>
            </div>
        </div>
        <ul class="nav nav-pills mb-3 gap-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active shadow-sm" id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                    aria-selected="true"><i class="fa fa-user me-1"></i>Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link  shadow-sm" id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false"><i class="fa fa-lock me-1"></i>
                    Change Password</button>
            </li>
        </ul>
        <div class="tab-content py-1" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="card">
                    <div class="card-header">Profile Details</div>
                    <div class="card-body shadow-sm py-4">
                        <form @submit.prevent="updateUser" enctype="multipart/form-data">
                            <div class="row mb-4">
                                <!-- Image Preview -->
                                <div class="col-md-1">
                                    <img v-if="form.image" :src="getImageSrc()" alt="Profile Image" width="65"
                                        height="65" />
                                </div>
                                <!-- Upload Button -->
                                <div class="col-md-5">
                                    <button type="button" class="btn btn-info btn-sm" @click="triggerFileInput">Upload
                                        New Photo</button>
                                    <input type="file" ref="fileInput" style="display: none;" @change="onFileSelect" />
                                    <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                                    <br>
                                    <label class="mt-1 text-secondary">Allowed JPG, GIF, or PNG. Max size of
                                        800K</label>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input class="form-control" id="inputName" type="text" placeholder="Enter your name"
                                        v-model="form.name" />
                                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" id="inputEmail" type="email"
                                        placeholder="name@example.com" v-model="form.email" />
                                    <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info w-100 mb-2" :disabled="loading">
                                <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                    aria-hidden="true"></span>
                                {{ loading ? 'Updating...' : 'Update' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card">
                    <div class="card-header">Change Password</div>
                    <div class="card-body shadow-sm py-5">
                        <form @submit.prevent="updatePassword">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input class="form-control" type="password" placeholder="Password"
                                        v-model="form2.password" />
                                    <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12 position-relative">
                                    <input :type="showConfirmPassword ? 'text' : 'password'" class="form-control"
                                        placeholder="Confirm Password" v-model="form2.password_confirmation" />
                                    <span class="position-absolute"
                                        style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"
                                        @click="toggleConfirmPassword">
                                        <i :class="showConfirmPassword ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info w-100 mb-2" :disabled="loading">
                                <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                    aria-hidden="true"></span>
                                {{ loading ? 'Changing...' : 'Change Password' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, inject, onMounted } from "vue";
import axios from "axios";

export default {
    setup() {
        const fileInput = ref(null);
        const loading = ref(false);
        const showConfirmPassword = ref(false);

        const form = reactive({
            id: null,
            name: null,
            email: null,
            image: null,
        });

        const form2 = reactive({
            id: null,
            password: null,
            password_confirmation: null,
        });

        const errors = reactive({});

        const fetchData = async () => {
            const token = localStorage.getItem("token");
            try {
                const res = await axios.get("/api/auth/me", {
                    headers: { Authorization: `Bearer ${token}` },
                });
                Object.assign(form, {
                    id: res.data.id,
                    name: res.data.name,
                    email: res.data.email,
                    image: res.data.image,
                });
                form2.id = res.data.id;
            } catch (error) {
                console.error(error.response?.data || error.message);
            }
        };

        const updateUser = async () => {
            loading.value = true;
            await axios.put("/api/userSelfUpdate", form)
                .then((res) => {
                    fetchData();
                    Toast.fire({
                        icon: "success",
                        title: res.data.message
                    });
                })
                .catch((error) => {
                    Object.assign(errors, error.response.data.errors);
                })
                .finally(() => {
                    loading.value = false
                })
        };

        const updatePassword = async () => {
            loading.value = true
            await axios.put("/api/userSelfUpdaePassword", form2)
                .then((res) => {
                    console.log(res)
                    fetchData();
                    Object.assign(form2, {
                        password: null,
                        password_confirmation: null,
                    });
                    Toast.fire({
                        icon: "success",
                        title: res.data.message
                    });
                })
                .catch((error) => {
                    Object.assign(errors, error.response.data.errors);
                })
                .finally(() => {
                    loading.value = false
                })
        };

        const triggerFileInput = () => fileInput.value.click();

        const onFileSelect = (event) => {
            const file = event.target.files[0];
            if (file.size > 1048576) {
                alert("Image must be less than 1 MB!");
            } else {
                const reader = new FileReader();
                reader.onload = (e) => (form.image = e.target.result);
                reader.readAsDataURL(file);
            }
        };

        const getImageSrc = () => (form.image?.startsWith("data") ? form.image : `/backend/images/users/${form.image}`);

        const toggleConfirmPassword = () => {
            showConfirmPassword.value = !showConfirmPassword.value;
        };

        onMounted(fetchData);

        return {
            fileInput,
            loading,
            showConfirmPassword,
            form,
            form2,
            errors,
            fetchData,
            updateUser,
            updatePassword,
            triggerFileInput,
            onFileSelect,
            getImageSrc,
            toggleConfirmPassword,
        };
    },
};
</script>
