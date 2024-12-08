<template>
    <div class="main-div">
        <div class="container-fluid admissionfair">
            <div class="contentload w-100 d-flex justify-content-between align-items-center w-100">
                <div class="content-image-academy-details w-100 d-flex align-items-center w-75">
                    <router-link to="/" class="academy-image me-3">
                        <img src="../../../../../public/frontend/images/efiailogo.png" width="95" height="95"
                            alt="Eternal Freedom Institute Logo">
                    </router-link>

                    <div class="academy-details" style="line-height: 1;">
                        <p>Eternal Freedom Institute Al Islamia</p>
                        <p>Gafargaon, Mymensing , Mymensingh</p>
                        <p>01711-022734</p>
                    </div>
                </div>
                <!-- Align this div to the right end -->
                <div class="admissionfaircontent d-flex justify-content-end align-items-center w-25">
                    <h1 class="text-white fw-bold me-4">ভর্তি মেলা</h1>
                </div>
            </div>
        </div>
        <h6 class="text-center fw-bold py-5  onlineadmission">Online Admission Form</h6>
        <section class="">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong addmissionlogin" style="border-radius: 1rem;">
                            <div class="card-body p-5">
                                <h3 class="mb-5 text-center">Create Account</h3>
                                <!-- <form>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label mb-0">Class Name</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select your class</option>
                                            <option v-for="classItem in admissionClasses" :key="classItem.id"
                                                :value="`${classItem.class_name}>${classItem.shift}>${classItem.section}>${classItem.group}>${classItem.session}`">
                                                {{ classItem.class_name }}
                                                <span v-if="classItem.class_name !=null">></span>{{ classItem.shift }}
                                                 <span v-if="classItem.shift != null">></span>{{classItem.section }}
                                                 <span v-if="classItem.section != null">></span>{{ classItem.group
                                                }}<span v-if="classItem.group != null">></span>{{ classItem.session }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label mb-0">Email/Mobile</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Enter your Email or mobile">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label mb-0">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1"
                                            placeholder="Enter your password">
                                    </div>
                                    <div
                                        class="button-forgate d-flex justify-content-between w-100 align-items-center mb-5">
                                        <router-link to="/admissionform"
                                            class="loginbutton btn btn-sm text-white fw-bold ms-auto">Next</router-link>
                                    </div>
                                </form> -->
                                <form @submit.prevent="submitForm">
                                    <div class="mb-3">
                                        <label for="class_name" class="form-label mb-0">Class Name</label>
                                        <select class="form-select" v-model="registerForm.class_id">
                                            <option value="" disabled>Select your class</option>
                                            <option v-for="classItem in admissionClasses" :key="classItem.id"
                                                :value="`${classItem.id}`">
                                                {{ classItem.class_name }}
                                                <span v-if="classItem.class_name != null">></span>{{ classItem.shift }}
                                                <span v-if="classItem.shift != null">></span>{{ classItem.section }}
                                                <span v-if="classItem.section != null">></span>{{ classItem.group }}
                                                <span v-if="classItem.group != null">></span>{{ classItem.session }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label mb-0">Email/Mobile</label>
                                        <input type="text" class="form-control" id="email"
                                            placeholder="Enter your Email or mobile" v-model="registerForm.email_mobile">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label mb-0">Password</label>
                                        <input type="password" class="form-control" id="password"
                                            placeholder="Enter your password" v-model="registerForm.password">
                                    </div>
                                    <div
                                        class="button-forgate d-flex justify-content-between w-100 align-items-center mb-5">
                                        <button type="submit"
                                            class="loginbutton btn btn-sm text-white fw-bold ms-auto">Next</button>
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
import axios from 'axios';
import { useRouter } from 'vue-router';
import { onMounted, ref } from 'vue';

export default {
    name: "AdmissionRegister",
    setup() {
        const router = useRouter();
        const admissionClasses = ref([]);
        const registerForm = ref({
            class_id: '',
            email_mobile: '',
            password: '',
        });
        const fetchAdmissionClass = async () => {
            const response = await axios.get(`/api/classes`);
            if (response.data && response.data.message) {
                admissionClasses.value = response.data.data;
            }
        }

        const submitForm = async () => {
            try {
                const response = await axios.post('/api/auth/admissionregister/store', registerForm.value);
                User.responseAfterLogin(response);
                router.push({ name: 'AdmissionForm' });
            } catch (error) {
                console.error(error);
            }
        };
        onMounted(() => {
            fetchAdmissionClass();
        })
        return {
            admissionClasses,
            fetchAdmissionClass,
            registerForm,
            submitForm
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

.admissionfair {
    width: 100%;
    height: 10vh;
    background-color: #d00473;
}

.academy-details p {
    line-height: 0.2;
    color: white;
}
</style>
