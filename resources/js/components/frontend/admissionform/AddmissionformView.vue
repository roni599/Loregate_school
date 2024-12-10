<template>
    <div class="main-div">
        <div class="container-fluid admissionfair">
            <div class="contentload w-100 d-flex justify-content-between align-items-center mt-lg-3">
                <!-- Left Content -->
                <div class="content-image-academy-details d-flex align-items-center">
                    <button class="btn btn-transparent p-0 border-0 academy-image" @click="Gohome">
                        <img :src="`/backend/images/academy/${academy_details.academy_logo}`" width="45" height="45"
                            class="rounded-circle me-2" alt="Academy Logo">
                    </button>
                    <div class="academy-details text-black" style="line-height: 1">
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
                <div class="admissionfaircontent d-flex justify-content-end align-items-center ms-4">
                    <h1 class="text-black fw-bold">ভর্তি মেলা</h1>
                </div>
            </div>
        </div>

        <div class="container my-5 border p-4">
            <div class="text-center mb-5 addmissionform">
                <p class="text-white admissionform d-inline-block h6 p-2 rounded-pill">Admission Form</p>
                <small class="float-end me-2 align-items-center py-2" v-if="studentInformationAll.created_at">Date:
                    {{ formattedDate }}</small>
            </div>
            <div class="row mb-3 w-100">
                <div class="notice col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                    <p>{{ studentClassInformation.information }}</p>
                </div>
                <div
                    class="student_image col-12 col-md-6 col-lg-3 d-flex justify-content-center  mb-3 mb-lg-0">
                    <img :src="`/backend/images/StudentsInformation/${studentInformationAll.st_picture}`" width="190"
                        height="170" alt="Eternal Freedom Institute Logo" />
                </div>
                <div class="admissionName col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                    <table class="table table-bordered  text-center">
                        <tbody>
                            <tr>
                                <th scope="row">Admission Class</th>
                                <td>{{ studentadmissionClassName.class_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Group</th>
                                <td>{{ studentadmissionsClassDetails.group }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Session</th>
                                <td>{{ studentadmissionsClassDetails.session }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Shift</th>
                                <td>{{ studentadmissionsClassDetails.shift }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Section</th>
                                <td>{{ studentadmissionsClassDetails.section }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="contact_person col-12 col-md-6 col-lg-3">
                    <p><strong>Contact Person</strong></p>
                    <p><strong>{{ studentInformationAll.st_guardian_contact_person }}</strong></p>
                    <p><strong>{{ studentInformationAll.st_guardian_name }}</strong></p>
                    <p><strong>{{ studentInformationAll.st_guardian_mobile }}</strong></p>
                    <p><strong>{{ studentInformationAll.st_guardian_email }}</strong></p>
                </div>
            </div>


            <div class="row mb-2">
                <div class="col-md-8">
                    <h5>Student Information</h5>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ studentInformationAll.st_name }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ studentInformationAll.st_gender }}</td>
                            </tr>
                            <tr>
                                <th>Religion</th>
                                <td>{{ studentInformationAll.st_religion }}</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td>{{ studentInformationAll.st_age }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ studentInformationAll.st_dob }}</td>
                            </tr>
                            <tr>
                                <th>Birth Certificate</th>
                                <td>{{ studentInformationAll.st_birth_certificate_no }}</td>
                            </tr>
                            <tr>
                                <th>NID No</th>
                                <td>{{ studentInformationAll.st_nid_no }}</td>
                            </tr>
                            <tr>
                                <th>Passport No</th>
                                <td>{{ studentInformationAll.st_passport_no }}</td>
                            </tr>
                            <tr>
                                <th>Nationality</th>
                                <td>{{ studentInformationAll.st_nationality }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ studentInformationAll.st_email }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ studentInformationAll.st_mobile }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                    <div class="present_address mb-5">
                        <p><strong>Present Address</strong></p>
                        <p>{{ studentInformationAll.st_pre_sub_district }}</p>
                        <p>Division: {{ studentInformationAll.st_pre_division }}</p>
                        <p>District: {{ studentInformationAll.st_pre_district }}</p>
                        <p>Sub-District: {{ studentInformationAll.st_pre_sub_district }}</p>
                    </div>
                    <div class="permanent_address">
                        <p><strong> Permanent Address</strong></p>
                        <p>{{ studentInformationAll.st_per_sub_district }}</p>
                        <p>Division: {{ studentInformationAll.st_per_division }}</p>
                        <p>District: {{ studentInformationAll.st_per_district }}</p>
                        <p>Sub-District: {{ studentInformationAll.st_per_sub_district }}</p>
                    </div>
                </div>

            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <h5>Father's Information</h5>
                    <table class="table table-bordered ">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ studentInformationAll.st_father_name }}</td>
                            </tr>
                            <tr>
                                <th>NID No</th>
                                <td>{{ studentInformationAll.st_father_nid_no }}</td>
                            </tr>
                            <tr>
                                <th>Passport No</th>
                                <td>{{ studentInformationAll.st_father_passport_no }}</td>
                            </tr>
                            <tr>
                                <th>Nationality</th>
                                <td>{{ studentInformationAll.st_father_nationality }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ studentInformationAll.st_father_email }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ studentInformationAll.st_father_mobile }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5>Mother's Information</h5>
                    <table class="table table-bordered ">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ studentInformationAll.st_mother_name }}</td>
                            </tr>
                            <tr>
                                <th>NID No</th>
                                <td>{{ studentInformationAll.st_mother_nid_no }}</td>
                            </tr>
                            <tr>
                                <th>Passport No</th>
                                <td>{{ studentInformationAll.st_mother_passport_no }}</td>
                            </tr>
                            <tr>
                                <th>Nationality</th>
                                <td>{{ studentInformationAll.st_mother_nationality }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ studentInformationAll.st_mother_email }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ studentInformationAll.st_mother_mobile }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>

            <div class="row mb-2">
                <div class="col-md-8">
                    <h5>Guardian's Information</h5>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Name</th>
                                <td>{{ studentInformationAll.st_guardian_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">NID No</th>
                                <td>{{ studentInformationAll.st_guardian_nid_no }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Passport No</th>
                                <td>{{ studentInformationAll.st_guardian_passport_no }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nationality</th>
                                <td>{{ studentInformationAll.st_guardian_nationality }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Mail</th>
                                <td>{{ studentInformationAll.st_guardian_email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Mobile</th>
                                <td>{{ studentInformationAll.st_guardian_mobile }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-4 d-flex flex-column align-items-start justify-content-center">
                    <div class="mainaddress mb-5 w-100">
                        <p class="fw-bold mb-1">Address</p>
                        <p class="mb-1">{{ formattedAddress }}</p>
                    </div>
                    <div class="studentrelation w-100">
                        <p class="fw-bold mb-2">Relation of Student</p>
                        <p class="mb-0">{{ studentInformationAll.st_guardian_contact_person }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <h5>Previous Academy Information</h5>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Education</th>
                                <th>Academy Name</th>
                                <th>Year</th>
                                <th>Class</th>
                                <th>Group</th>
                                <th>Roll</th>
                                <th>Final Exam Merit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="education in studentEducations" :key="education">
                                <td>{{ education.education }}</td>
                                <td>{{ education.academy_name }}</td>
                                <td>{{ education.year }}</td>
                                <td>{{ education.class }}</td>
                                <td>{{ education.group }}</td>
                                <td>{{ education.roll }}</td>
                                <td>{{ education.result }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="container mt-4">
                <div class="terms-container">
                    <p class="fw-bold">Terms & Conditions</p>
                    <div class="terms-content">
                        <ul class="terms-list">
                            <li v-for="(item, index) in splitTermsAndConditions" :key="index">
                                {{ item }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="row container mb-3">
                <div class="col-md-6">
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1"> I’m Agree Tram & Condition</label>
                    </div>
                </div>
            </div>

            <div class="row container mb-2">
                <div class="col-md-2">
                    <p class="idno">ID No: {{ studentInformationAll.student_id }}</p>
                </div>
                <div class="col-md-10">
                    <img src="../../../../../public/frontend/images/unpaid.jpg" width="50" height="50" alt="">
                </div>
            </div>
            <div class="row container mb-2">
                <div class="col-md-4">
                    <h4 class="fw-bold">Fee: <span class="text-danger">{{ admissionFee.fee }}</span></h4>
                </div>
            </div>

            <div class="row container mb-3 align-items-center">
                <div class="col-md-3 d-flex align-items-center">
                    <p class="mb-0">Please Payment Online</p>
                </div>
                <div class="col-md-3">
                    <div class="payment_image d-flex justify-content-center gap-4">
                        <img src="../../../../../public/frontend/images/bkash.webp" width="100" height="50" alt="">
                        <img src="../../../../../public/frontend/images/visa2.webp" width="100" height="50" alt="">
                        <img src="../../../../../public/frontend/images/ssl.png" width="100" height="50" alt="">
                    </div>
                </div>
            </div>

            <div class="button-forgate d-flex justify-content-between w-100 align-items-center">
                <button class="loginbutton btn btn-sm text-white fw-bold ms-auto" @click="printPage">Save &
                    Download</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref, computed } from 'vue';
import { useRouter } from 'vue-router';
export default {
    name: "AddmissionfromView",
    setup() {
        const router = useRouter();
        const token = localStorage.getItem("token");
        const studentadmissionsClassDetails = ref({});
        const studentadmissionClassName = ref('');
        const studentInformationAll = ref({});
        const studentEducations = ref([]);
        const termsAndConditions = ref('');
        const admissionFee = ref('');
        const academy_details = ref({});
        const isMobile = ref(false);
        const studentClassInformation = ref({});

        const fetchStudentAdmissions = async () => {
            try {
                const response = await axios.get("/api/studentadmission/find", {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                if (response.data && response.data.message) {

                    studentInformationAll.value = response.data.data;
                    let jsonString = response.data.data.education;
                    studentEducations.value = JSON.parse(jsonString);
                    const fullString = response.data.data.admission.admission_assign.class_details
                    studentadmissionClassName.value = response.data.data.admission.admission_assign;
                    admissionFee.value = response.data.data.admission.admission_assign;

                    studentadmissionsClassDetails.value = Object.assign({}, fullString.split('>').reduce((acc, curr, index) => {
                        const keys = ['shift', 'section', 'group', 'session'];
                        acc[keys[index]] = curr;
                        return acc;
                    }, {}));
                }
            } catch (error) {
                console.error("Error fetching class data:", error);
            }
        };
        const printPage = () => {
            window.print();
        };

        const admissionClassInformation = async () => {
            try {
                const response = await axios.get(`/api/studentadmission/classinformation/find`, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                if (response.data && response.data.message) {
                    studentClassInformation.value = response.data.data
                }
            } catch (error) {

            }
        }

        const formattedAddress = computed(() => {
            if (studentInformationAll.value.st_guardian_address) {
                const addressParts = studentInformationAll.value.st_guardian_address.split(',');
                return addressParts.length >= 6
                    ? `${addressParts[0]}, ${addressParts[1]}${addressParts[2]}, ${addressParts[3]}${addressParts[4]}, ${addressParts[5]}`
                    : studentInformationAll.value.st_guardian_address;
            }
            return null;
        });
        const conditions = async () => {
            try {
                const response = await axios.get(`api/terms-condition`);
                if (response.data && response.data.message) {
                    termsAndConditions.value = response.data.data.content
                }
            } catch (error) {

            }
        }
        const formattedDate = computed(() => {
            const date = new Date(studentInformationAll.value.created_at);
            const day = ("0" + date.getDate()).slice(-2);
            const month = ("0" + (date.getMonth() + 1)).slice(-2);
            const year = date.getFullYear();

            return `${day}/${month}/${year}`;
        });
        const splitTermsAndConditions = computed(() => {
            return termsAndConditions.value.split('.').filter(item => item.trim() !== '');
        });

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

        const formatAddress = (address) => {
            let formattedAddress = '';
            let i = 0;
            while (i < address.length) {
                formattedAddress += address.substring(i, i + 50) + '<br>';
                i += 50;
            }
            return formattedAddress;
        };
        const checkScreenSize = () => {
            isMobile.value = window.innerWidth <= 768; // Mobile breakpoint
        };

        onMounted(async () => {
            if (!token) {
                router.push({ name: "HomeFront" });
            } else {
                try {
                    await Promise.all([fetchStudentAdmissions(), conditions(), fetchAcademy(), admissionClassInformation()]);
                    window.addEventListener("resize", checkScreenSize);
                } catch (error) {
                    console.error("Error during onMounted execution:", error);
                }
            }
        });
        const Gohome = () => {
            localStorage.clear('token');
            localStorage.clear('student_id');
            router.push({ name: "HomeFront" })
        }
        return {
            Gohome,
            printPage,
            fetchStudentAdmissions,
            studentadmissionClassName,
            studentadmissionsClassDetails,
            studentInformationAll,
            formattedAddress,
            studentEducations,
            conditions,
            splitTermsAndConditions,
            admissionFee,
            formattedDate,
            fetchAcademy,
            academy_details,
            isLongName,
            formatAddress,
            checkScreenSize,
            isMobile,
            admissionClassInformation,
            studentClassInformation
        }
    }
}
</script>

<style scoped>
.admissionfair {
    width: 100%;
    height: 12vh;
    background-color: #f7fa87;
}

.academy-details h5,
h6 {
    line-height: 0.8;
    color: black;
}

.admissionform {
    background-color: #004aac;
}

.present_address p {
    line-height: 0.5;
}

.contact_person p {
    line-height: 0.5;
}

.permanent_address p {
    line-height: 0.5;
}

.mainaddress p {
    line-height: 1;
}

.studentrelation p {
    line-height: 0.5;
}

.idno {
    color: #ac8af2;
}

.loginbutton {
    background-color: #2865b8;
    border-radius: 15px;
    padding: 5px 15px;
}

/* General styling */
body {
    font-family: Arial, sans-serif;
    font-size: 14px;
    /* Adjust this as needed */
}


/* Styles for printing */
@media print {
    .admissionfair {
        width: 100%;
        height: 5vh;
        background-color: #f7fa87;
    }

    .admissionform {
        background-color: #004aac;
    }

    .present_address p {
        line-height: 0.5;
    }

    .permanent_address p {
        line-height: 0.5;
    }

    .mainaddress p {
        line-height: .5;
    }

    .studentrelation p {
        line-height: 0.5;
    }

    .idno {
        color: #ac8af2;
    }

    .loginbutton {
        background-color: #2865b8;
        border-radius: 15px;
        padding: 5px 15px;
    }

    /* General styling */
    body {
        font-family: Arial, sans-serif;
        font-size: 20px;
        /* Adjust this as needed */
    }


}
</style>