<template>
    <div class="main-div">
        <div class="container-fluid admissionfair">
            <div class="contentload w-100 d-flex justify-content-between align-items-center mt-lg-3">
                <!-- Left Content -->
                <div class="content-image-academy-details d-flex align-items-center">
                    <button class="btn btn-transparent p-0 border-0 academy-image" @click="Gohome">
                        <img v-if="academy_details.academy_logo"
                            :src="`/backend/images/academy/${academy_details.academy_logo}`" width="45" height="45"
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
        <div class="container-fluid page-break-avoid forprint">
            <div class="contentload w-100 d-flex justify-content-center align-items-center">
                <!-- Left Content -->
                <div class="content-image-academy-details d-flex align-items-center">
                    <button class="btn btn-transparent p-0 border-0 academy-image" @click="Gohome">
                        <img v-if="academy_details.academy_logo"
                            :src="`/backend/images/academy/${academy_details.academy_logo}`" width="45" height="45"
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
            </div>
        </div>

        <div class="container my-2  border p-4">
            <div class="text-center mb-3 addmissionform">
                <p class="text-white admissionform d-inline-block p-2 rounded-pill">Admission Form</p>
                <small class="float-end me-2 align-items-center py-2" v-if="studentInformationAll.created_at">Date:
                    {{ formattedDate }}</small>
            </div>
            <div class="row w-100">
                <div class="notice col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                    <p>{{ studentClassInformation.information }}</p>
                </div>
                <div class="student_image col-12 col-md-6 col-lg-3 d-flex justify-content-center mb-lg-0">
                    <img v-if="studentInformationAll.st_picture"
                        :src="`/backend/images/StudentsInformation/${studentInformationAll.st_picture}`"
                        alt="Eternal Freedom Institute Logo" class="passport-img" />

                </div>
                <div class="admissionName col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                    <table class="table table-bordered  text-center">
                        <tbody>
                            <tr>
                                <td scope="row">Admission Class</td>
                                <td>{{ studentadmissionClassName.class_name }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Group</td>
                                <td>
                                    <span v-if="studentadmissionsClassDetails.group == null">N/A</span>
                                    <span v-else>{{ studentadmissionsClassDetails.group }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td scope="row">Session</td>
                                <td>{{ studentadmissionsClassDetails.session }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Shift</td>
                                <td>{{ studentadmissionsClassDetails.shift }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Section</td>
                                <td>{{ studentadmissionsClassDetails.section }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="contact_person col-12 col-md-6 col-lg-3">
                    <p>Contact Person</p>
                    <p>{{ studentInformationAll.st_guardian_contact_person }}</p>
                    <p>{{ studentInformationAll.st_guardian_name }}</p>
                    <p>{{ studentInformationAll.st_guardian_mobile }}</p>
                    <p>{{ studentInformationAll.st_guardian_email }}</p>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <p class="fw-bold">Student Information</p>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ studentInformationAll.st_name }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ studentInformationAll.st_gender }}</td>
                            </tr>
                            <tr>
                                <td>Religion</td>
                                <td>{{ studentInformationAll.st_religion }}</td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td>{{ studentInformationAll.st_age }}</td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td>{{ studentInformationAll.st_dob }}</td>
                            </tr>
                            <tr>
                                <td>Birth Certificate</td>
                                <td>{{ studentInformationAll.st_birth_certificate_no }}</td>
                            </tr>
                            <tr>
                                <td>NID No</td>
                                <td>{{ studentInformationAll.st_nid_no }}</td>
                            </tr>
                            <tr>
                                <td>Passport No</td>
                                <td>{{ studentInformationAll.st_passport_no }}</td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>{{ studentInformationAll.st_nationality }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ studentInformationAll.st_email }}</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
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

            <div class="row">
                <div class="col-md-6">
                    <p class="fw-bold">Father's Information</p>
                    <table class="table table-bordered ">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ studentInformationAll.st_father_name }}</td>
                            </tr>
                            <tr>
                                <td>NID No</td>
                                <td>{{ studentInformationAll.st_father_nid_no }}</td>
                            </tr>
                            <tr>
                                <td>Passport No</td>
                                <td>{{ studentInformationAll.st_father_passport_no }}</td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>{{ studentInformationAll.st_father_nationality }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ studentInformationAll.st_father_email }}</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{ studentInformationAll.st_father_mobile }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <p class="fw-bold">Mother's Information</p>
                    <table class="table table-bordered ">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ studentInformationAll.st_mother_name }}</td>
                            </tr>
                            <tr>
                                <td>NID No</td>
                                <td>{{ studentInformationAll.st_mother_nid_no }}</td>
                            </tr>
                            <tr>
                                <td>Passport No</td>
                                <td>{{ studentInformationAll.st_mother_passport_no }}</td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>{{ studentInformationAll.st_mother_nationality }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ studentInformationAll.st_mother_email }}</td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td>{{ studentInformationAll.st_mother_mobile }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>

            <div class="row">
                <div class="col-md-8">
                    <p class="fw-bold">Guardian's Information</p>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td scope="row">Name</td>
                                <td>{{ studentInformationAll.st_guardian_name }}</td>
                            </tr>
                            <tr>
                                <td scope="row">NID No</td>
                                <td>{{ studentInformationAll.st_guardian_nid_no }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Passport No</td>
                                <td>{{ studentInformationAll.st_guardian_passport_no }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Nationality</td>
                                <td>{{ studentInformationAll.st_guardian_nationality }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Mail</td>
                                <td>{{ studentInformationAll.st_guardian_email }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Mobile</td>
                                <td>{{ studentInformationAll.st_guardian_mobile }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-4 d-flex flex-column align-items-start mb-2 justify-content-center">
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
            <div class="">
                <p class="fw-bold">Previous Academy Information</p>
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


            <div class="container">
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

            <div class="row container">
                <div class="col-md-6">
                    <div class="mb-1 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1"
                            v-model="studentInformationAll.terms_condition"
                            :checked="studentInformationAll.terms_condition === 1">
                        <label class="form-check-label" for="exampleCheck1">
                            I’m Agree Tram & Condition
                        </label>
                    </div>
                </div>
            </div>


            <div class="row container">
                <div class="col-md-2">
                    <p class="idno">ID No: {{ studentInformationAll.student_id }}</p>
                </div>
                <div class="col-md-10">
                    <img src="../../../../../public/frontend/images/unpaid.jpg" width="50" height="50" alt="">
                </div>
            </div>
            <div class="row container">
                <div class="col-md-4">
                    <h5 class="fw-bold">Fee: <span class="text-danger">{{ admissionFee.fee }}</span></h5>
                </div>
            </div>

            <div class="row container  align-items-center">
                <div class="col-md-3 d-flex align-items-center">
                    <p class="mb-0">Please Payment Online</p>
                </div>
                <div class="col-md-3">
                    <div class="payment_image d-flex justify-content-center gap-4">
                        <img src="../../../../../public/frontend/images/bkash.webp" width="100" height="40" alt="">
                        <img src="../../../../../public/frontend/images/visa2.webp" width="100" height="40" alt="">
                        <img src="../../../../../public/frontend/images/ssl.png" width="100" height="40" alt="">
                    </div>
                </div>
            </div>

            <div class="button-forgate d-flex justify-content-between w-100 align-items-center printbuttondiv">
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

                    // studentadmissionsClassDetails.value = Object.assign({}, fullString.split('>').reduce((acc, curr, index) => {
                    //     const keys = ['shift', 'section', 'group', 'session'];
                    //     acc[keys[index]] = curr;
                    //     return acc;
                    // }, {}));

                    const keys = ['shift', 'section', 'group', 'session'];
                    studentadmissionsClassDetails.value = Object.assign(
                        {},
                        fullString.split('>').reduce((acc, curr, index) => {
                            acc[keys[index]] = (curr === 'null' || !curr.trim()) ? 'N/A' : curr.trim();
                            return acc;
                        }, {})
                    );

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
                console.log(response)
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
            isMobile.value = window.innerWidth <= 768;
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

body {
    font-family: Arial, sans-serif;
    font-size: 14px;
}

.forprint {
    display: none;
}

.passport-img {
    width: 180px;
    height: 190px;
}


@media print {
    body {
        margin: 0;
        padding: 0;
    }

    .container-fluid,
    .container {
        margin-bottom: 20px;
    }

    table {
        page-break-inside: avoid;
    }

    .notice {
        line-height: 1.2;
    }


    .main-div {
        background-color: white;
        font-size: 25px;
        line-height: 0.9;
    }

    .admissionfair {
        display: none !important;
    }

    .printbuttondiv {
        display: none !important;
    }

    .forprint {
        display: block !important;
    }

    body {
        transform: scale(0.9);
        transform-origin: top left;
    }

    .education_font_size {
        font-size: 30px !important;
        font-weight: bold !important;
    }
}
</style>
