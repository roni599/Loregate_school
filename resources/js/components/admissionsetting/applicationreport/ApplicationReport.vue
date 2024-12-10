<template>
    <div class="container-fluid pp">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
                <span class="text-muted h5"> / Application-report</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-1">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Application Report</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="text" id="searchInput" v-model="searchStock" placeholder="Search for ID.." />
                        <div class="table_size">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">S.L</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Applyed Class</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Gurdian</th>
                                        <th scope="col">Contract</th>
                                        <th scope="col">ID No</th>
                                        <th scope="col">Admission Fee</th>
                                        <th scope="col">Apply Date</th>
                                        <th scope="col">Payment Date</th>
                                        <th scope="col">Payment Type</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(admission, index) in filteredStocks" :key="admission.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ admission.st_name }}</td>
                                        <td>{{ admission.admissionassign.class_name }}>{{
                                            admission.admissionassign.class_details }}</td>
                                        <td>{{ admission.st_gender }}</td>
                                        <td>{{ admission.st_guardian_name }}</td>
                                        <td>{{ admission.st_guardian_mobile }}</td>
                                        <td>{{ admission.st_guardian_nid_no }}</td>
                                        <td>{{ admission.admissionassign.fee }}</td>
                                        <td>
                                            <div>{{ formatDateTime(admission.created_at).date }}</div>
                                            <div>{{ formatDateTime(admission.created_at).time }}</div>
                                        </td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>
                                            <div class="d-flex">
                                                <button @click="jsPDF(admission.id)"
                                                    class="btn btn-sm btn-primary me-2 bg-transparent text-black border-0 fs-5">
                                                    <i class="fa-solid fa-download"></i>
                                                </button>
                                                <button @click="toggleModal(admission.id)"
                                                    class="btn btn-sm btn-secondary bg-transparent text-black border-0 fs-5">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close d-flex justify-content-end" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container px-4 py-2 border" ref="document" id="element-to-convert">
                        <div class="text-center mt-3  mb-2 addmissionform">
                            <p class="text-white admissionform d-inline-block h6 p-2 rounded-pill">Admission Form</p>
                            <small class="float-end me-2 align-items-center py-2"
                                v-if="studentInformationAll.created_at">Date:
                                {{ formattedDate }}</small>
                        </div>
                        <div class="row mt-3 mb-2 w-100">
                            <div class="notice col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
                                <p>{{ studentClassInformation.information }}</p>
                            </div>
                            <div
                                class="student_image col-12 col-md-6 col-lg-3 d-flex justify-content-center  mb-3 mb-lg-0">
                                <img v-if="studentInformationAll.st_picture"
                                    :src="`/backend/images/StudentsInformation/${studentInformationAll.st_picture}`"
                                    width="190" height="205" alt="Eternal Freedom Institute Logo" />
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
                        <div class="">
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

                        <div class="row container mb-3">
                            <div class="col-md-6">
                                <div class=" form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1"> I’m Agree Tram &
                                        Condition</label>
                                </div>
                            </div>
                        </div>

                        <div class="row container mb-2">
                            <div class="col-md-2">
                                <p class="idno">ID No: {{ studentInformationAll.student_id }}</p>
                            </div>
                            <div class="col-md-10">
                                <img src="../../../../../public/frontend/images/unpaid.jpg" width="50" height="50"
                                    alt="">
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
                                    <img src="../../../../../public/frontend/images/bkash.webp" width="100" height="50"
                                        alt="">
                                    <img src="../../../../../public/frontend/images/visa2.webp" width="100" height="50"
                                        alt="">
                                    <img src="../../../../../public/frontend/images/ssl.png" width="100" height="50"
                                        alt="">
                                </div>
                            </div>
                        </div>

                        <div class="button-forgate d-flex justify-content-between w-100 align-items-center">
                            <button class="loginbutton btn btn-sm text-white fw-bold ms-auto" @click="printPage">Save &
                                Download</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref, computed } from 'vue';
import html2pdf from 'html2pdf.js';
export default {
    name: "ApplicationReport",
    setup() {
        const admissionReport = ref([]);
        const searchStock = ref('');
        const studentInformationAll = ref({});
        const studentEducations = ref([]);
        const studentadmissionClassName = ref('');
        const admissionFee = ref('');
        const studentadmissionsClassDetails = ref({});
        const studentClassInformation = ref({});
        const termsAndConditions = ref('');

        const toggleModal = (id) => {
            fetchStudentAdmissions(id)
            admissionClassInformation(id)
            conditions()
            const modal = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
            modal.show();
        }

        const jsPDF = async (id) => {
            try {
                // Make all API requests concurrently using Promise.all
                const [studentResponse, classInfoResponse, termsResponse] = await Promise.all([
                    axios.get(`/api/studentadmission/finddata/${id}`),
                    axios.get(`/api/studentadmission/classinformation/finddata/${id}`),
                    axios.get(`api/terms-condition`)
                ]);

                // Handle student data response
                if (studentResponse.data && studentResponse.data.message) {
                    console.log(studentResponse)
                    const studentData = studentResponse.data.data;
                    studentInformationAll.value = studentData;

                    // Parse and set education information
                    let jsonString = studentData.education;
                    studentEducations.value = JSON.parse(jsonString);

                    // Set admission class and fee details
                    const classDetails = studentData.admissionassign.class_details;
                    studentadmissionClassName.value = studentData.admissionassign;
                    admissionFee.value = studentData.admissionassign;

                    // Split class details into individual values
                    studentadmissionsClassDetails.value = Object.assign({}, classDetails.split('>')
                        .reduce((acc, curr, index) => {
                            const keys = ['shift', 'section', 'group', 'session'];
                            acc[keys[index]] = curr;
                            return acc;
                        }, {}));
                }

                // Handle class information response
                if (classInfoResponse.data && classInfoResponse.data.message) {
                    console.log(classInfoResponse)
                    studentClassInformation.value = classInfoResponse.data.data;
                }

                // Handle terms and conditions response
                if (termsResponse.data && termsResponse.data.message) {
                    console.log(termsResponse)
                    termsAndConditions.value = termsResponse.data.data.content;
                }

                html2pdf(document.getElementById('element-to-convert'),{
                    margin:1,
                    filename:'okey2-html.pdf'
                })

            } catch (error) {
                console.error("Error fetching data:", error);
            }
        };


        const formatDateTime = (dateString) => {
            const date = new Date(dateString.replace(" ", "T")); // Ensure ISO format
            const dateOptions = {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
            };
            const timeOptions = {
                hour: "2-digit",
                minute: "2-digit",
                hour12: true,
            };

            const dateFormatted = date.toLocaleDateString("en-GB", dateOptions); // DD/MM/YYYY
            const timeFormatted = date.toLocaleTimeString("en-GB", timeOptions); // hh:mm AM/PM

            return {
                date: dateFormatted,
                time: timeFormatted,
            };
        };

        const fetchAdmissionData = async () => {
            try {
                const response = await axios.get(`/api/studentadmissions`);
                admissionReport.value = response.data.data
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

        const fetchStudentAdmissions = async (id) => {
            try {
                const response = await axios.get(`/api/studentadmission/finddata/${id}`);
                if (response.data && response.data.message) {

                    studentInformationAll.value = response.data.data;
                    let jsonString = response.data.data.education;
                    studentEducations.value = JSON.parse(jsonString);
                    const fullString = response.data.data.admissionassign.class_details
                    studentadmissionClassName.value = response.data.data.admissionassign;
                    admissionFee.value = response.data.data.admissionassign;

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

        const admissionClassInformation = async (id) => {
            try {
                const response = await axios.get(`/api/studentadmission/classinformation/finddata/${id}`);
                if (response.data && response.data.message) {
                    studentClassInformation.value = response.data.data
                }
            } catch (error) {

            }
        }

        const filteredStocks = computed(() => {
            return admissionReport.value.filter((stock) => {
                return (
                    stock.id.toString().includes(searchStock.value) || stock.st_gender.toLowerCase().includes(searchStock.value.toLowerCase()) || stock.admissionassign.class_name.toLowerCase().includes(searchStock.value.toLowerCase())
                );
            });
        });
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
        const conditions = async () => {
            try {
                const response = await axios.get(`api/terms-condition`);
                if (response.data && response.data.message) {
                    termsAndConditions.value = response.data.data.content
                }
            } catch (error) {

            }
        }
        const printPage = () => {
            window.print();
        };

        onMounted(() => {
            fetchAdmissionData();
        })
        return {
            admissionReport,
            fetchAdmissionData,
            formatDateTime,
            searchStock,
            filteredStocks,
            toggleModal,
            fetchStudentAdmissions,
            studentInformationAll,
            studentEducations,
            studentadmissionClassName,
            admissionFee,
            studentadmissionsClassDetails,
            admissionClassInformation,
            studentClassInformation,
            formattedAddress,
            splitTermsAndConditions,
            termsAndConditions,
            formattedDate,
            conditions,
            printPage,
            jsPDF
        }
    }
}
</script>

<style scoped>
.table_size {
    width: 100%;
    overflow: auto;
}

#searchInput {
    background-image: url("/backend/assets/img/searchicon.png");
    background-position: 10px 12px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
}

.loginbutton {
    background-color: #2865b8;
    border-radius: 15px;
    padding: 5px 15px;
}

.admissionform {
    background-color: #004aac;
}


body {
    overflow: auto;
}

@media print {
    body {
        overflow: hidden;
        height: 100vh;

    }

    .admissionform {
        background-color: #004aac !important;
        color: black;
        font-weight: bold;
    }

    #exampleModalToggle .modal-body {
        overflow: hidden;
    }

    #exampleModalToggle .modal-header,
    #exampleModalToggle .modal-footer {
        border: none;
    }

    html,
    body {
        width: 100%;
        margin: 0;
        padding: 0;

    }

    .page-content {
        page-break-before: always;
        overflow: visible;
    }

    .modal-content {
        border: none !important;
    }


}
</style>