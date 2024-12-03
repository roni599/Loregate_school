<template>
    <main-div>
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
                                <h3 class="mb-5 text-center">Forget password</h3>
                                <form>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label mb-0">Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp"
                                            placeholder="Enter your emain for reset password">
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn w-100 btn-primary submitbutton">Submit</button>
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
    </main-div>

</template>

<script>
import router from '../../../routes/router';

export default {
    name: "AdmissionLogin",
    setup() {
        return {}
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
.submitbutton{
    background-color: #004aac;
    border: none;
}
</style>
