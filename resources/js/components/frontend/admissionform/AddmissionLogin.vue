<template>
    <div class="main-div">
        <div class="container-fluid admissionfair mb-3">
            <div class="contentload w-100 d-flex justify-content-between align-items-center mt-lg-2">
                <!-- Left Content -->
                <div class="content-image-academy-details d-flex align-items-center">
                    <button class="btn btn-transparent p-0 border-0 academy-image" @click="Gohome">
                        <img :src="`/backend/images/academy/${academy_details.academy_logo}`" width="45" height="45"
                            class="rounded-circle me-2" alt="Academy Logo">
                    </button>
                    <div class="academy-details text-white" style="line-height: 1">
                        <template v-if="isMobile && isLongName">
                            <marquee class="m-0 education_font_size">
                                {{ academy_details.academy_name || "Loregate School and College" }}
                            </marquee>
                        </template>
                        <template v-else>
                            <p class="m-0 education_font_size">
                                {{ academy_details.academy_name || "Loregate School and College" }}
                            </p>
                        </template>
                        <span class="d-block education_font">
                            <span
                                v-html="formatAddress(academy_details.academy_address || 'Address not available')"></span>
                        </span>
                        <span class="d-block education_font">
                            {{ academy_details.academy_mobile_number || "Phone not available" }}
                        </span>
                    </div>
                </div>
                <!-- Right Content -->
                <div class="admissionfaircontent d-flex justify-content-end align-items-center mt-2 ms-4">
                    <h1 class="text-white fw-bold">ভর্তি মেলা</h1>
                </div>
            </div>
        </div>
        <h6 class="text-center fw-bold py-4  onlineadmission">Online Admission Form</h6>
        <section class="">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong addmissionlogin" style="border-radius: 1rem;">
                            <div class="card-body p-5">
                                <h3 class="mb-5 text-center">Login Form</h3>
                                <form @submit.prevent="submitLogin">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label mb-0">Email/Mobile</label>
                                        <input type="email" v-model="loginForm.email" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label mb-0">Password</label>
                                        <input v-model="loginForm.password" type="password" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div
                                        class="button-forgate d-flex justify-content-between w-100 align-items-center mb-5">
                                        <div class="forgetpassword w-50">
                                            <router-link to="/admissionforget">Forgot Password?</router-link>
                                        </div>
                                        <div class="w-50 text-end">
                                            <button class="loginbutton btn btn-sm text-white fw-bold">Login</button>
                                        </div>
                                    </div>

                                    <div class="newAccount">
                                        <p class="mb-3">New Account For Admission?</p>
                                        <router-link to="/admissionregister"
                                            class="btn btn-primary createaccount">Create Account</router-link>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</template>

<script>
import { onMounted, ref,computed } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
export default {
    name: "AdmissionLogin",
    setup() {
        const router = useRouter();
        const academy_details=ref({});
        const isMobile = ref(false);
        const loginForm = ref({
            email: '',
            password: ''
        })

        const submitLogin = async () => {
            const response = await axios.post(`/api/auth/admissionregister/login`, loginForm.value);
            if (response.data) {
                localStorage.setItem('token', response.data.access_token);
                localStorage.setItem('student_id', response.data.student_id);
                router.push({ name: 'AdmissionForm' });
            }
        }
        const fetchAcademy = async () => {
            try {
                const response = await axios.get(`/api/academy/header`);
                if (response.data?.data) {
                    academy_details.value = response.data.data;
                    document.title = academy_details.value.academy_name || "Loregate School and College";
                    if (academy_details.value.academy_logo) {
                        const faviconElement = document.getElementById('dynamic-favicon');
                        if (faviconElement) {
                            faviconElement.href = `/backend/images/academy/${academy_details.value.academy_logo}`;
                        }
                    }
                }
            } catch (error) {
                console.error("Error fetching academy details:", error.message);
            }
        };
        const isLongName = computed(() =>
            (academy_details.value.academy_name || "Loregate School and College").length > 26
        );
        const checkScreenSize = () => {
            isMobile.value = window.innerWidth <= 768;
        };
        const Gohome = () => {
            router.push({ name: "HomeFront" })
        }
        const formatAddress = (address) => {
            let formattedAddress = '';
            let i = 0;
            while (i < address.length) {
                formattedAddress += address.substring(i, i + 50) + '<br>';
                i += 50;
            }
            return formattedAddress;
        };
        onMounted(()=>{
            fetchAcademy();
        })

        return {
            Gohome,
            loginForm,
            submitLogin,
            fetchAcademy,
            academy_details,
            isMobile,
            isLongName,
            checkScreenSize,
            formatAddress
        }
    }
}
</script>

<style scoped>
.addmissionlogin {
    background-color: #e7def7;
}

.loginbutton {
    background-color: #d00473;
    border-radius: 15px;
    padding: 5px 15px;
}

.createaccount {
    border-radius: 25px;
    padding: 5px 30px;
    background-color: #004aac;
    border: none;
}

.onlineadmission {
    color: #5586c7;
}

.onlineadmission {
    color: #5586c7;
}

.admissionfair {
    width: 100%;
    height: 12vh;
    background-color: #d00473;
}

.academy-details p {
    line-height: 0.9;
    color: white;
}
</style>
