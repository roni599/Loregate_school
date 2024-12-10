<template>
    <div class="main-div">
        <div class="container-fluid admissionfair">
            <div class="contentload w-100 d-flex justify-content-between align-items-center">
                <!-- Left Content -->
                <div class="content-image-academy-details d-flex align-items-center">
                    <button class="btn btn-transparent p-0 border-0 academy-image" @click="Gohome">
                        <img v-if="academy_details.academy_logo"
                            :src="`/backend/images/academy/${academy_details.academy_logo}`" width="45" height="45"
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
        <div class="details_time d-flex flex-column flex-md-row justify-content-between align-items-center container">
            <!-- Online Admission Title -->
            <h6 class="text-center fw-bold py-3 onlineadmission mx-auto">
                Online Admission Form
            </h6>

            <!-- Admission Dates and Times -->
            <p class="text-end mt-2">
                <span>
                    <span class="text_color fw-bold">Start Date: </span>
                    <span class="fw-bold">{{ classData.start_date }}</span>
                    <span class="text_color fw-bold">&nbsp;Time: </span>
                    <span class="fw-bold">{{ formatTime(classData.start_time) }}</span>
                    <br />
                    <span class="text_color fw-bold">End Date: </span>
                    <span class="fw-bold">{{ classData.end_date }}</span>
                    <span class="text_color fw-bold">&nbsp;Time: </span>
                    <span class="fw-bold">{{ formatTime(classData.end_time) }}</span>
                </span>
            </p>
        </div>

        <div class="container mb-5">
            <div class="card">
                <div class="card-body">
                    <p v-if="classData && classData.class_details" class="mb-2">
                        <span class="addmissionclass fw-bold">Admission Class </span> :
                        {{ classData.class_name }}> {{ cleanedClassDetails }}
                    </p>
                    <p class="fee fw-bold mb-4">Fee: {{ classData.fee }}</p>
                    <form action="" class="" @submit.prevent="submitForm">
                        <input type="hidden" v-model="classData.id" />
                        <div class="formName mb-3" v-for="form in Formnames" :key="form.id">
                            <p class="studentinformation">{{ form.name }}</p>
                            <div class="row">
                                <div class="col-md-4 mb-2" v-for="field in getFieldsByFormId(form.id)" :key="field.id">
                                    <div class="inputfield">
                                        <label :for="field.field_name">{{ field.field_name }}</label>
                                        <div v-if="field.field_type === 'text'">
                                            <input :type="field.field_type" :id="field.field_name"
                                                :name="field.field_name" :required="field.required === 1"
                                                class="form-control" v-model="field.value" />
                                        </div>
                                        <div v-else-if="field.field_type === 'select'">
                                            <select :id="field.field_name" :name="field.field_name"
                                                :required="field.required === 1" class="form-control"
                                                v-model="field.value">
                                                <option value="" disabled selected>Open this select menu</option>
                                                <option v-for="option in field.options" :key="option" :value="option">
                                                    {{ option }}
                                                </option>
                                            </select>
                                        </div>
                                        <div v-else-if="field.field_type === 'date'">
                                            <input :type="field.field_type" :id="field.field_name"
                                                :name="field.field_name" :required="field.required === 1"
                                                class="form-control" v-model="field.value" />
                                        </div>
                                        <div v-else-if="field.field_type === 'email'">
                                            <input :type="field.field_type" :id="field.field_name"
                                                :name="field.field_name" :required="field.required === 1"
                                                class="form-control" v-model="field.value" />
                                        </div>
                                        <div v-else-if="field.field_type === 'file'">
                                            <!-- Picture Input -->
                                            <div v-if="field.field_name === 'Picture'" class="container mt-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-center text-center">
                                                            <input :type="field.field_type" id="signatureInput"
                                                                name="signature" :required="field.required === 1"
                                                                @change="onFileSelect2" class="form-control"
                                                                ref="fileInput" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Signature Input -->
                                            <div v-if="field.field_name === 'Signature'" class="container mt-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-center text-center">
                                                            <input :type="field.field_type" id="signatureInput"
                                                                name="signature" :required="field.required === 1"
                                                                class="form-control" @change="onFileSelect"
                                                                ref="fileInput" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="studentinformation mb-2">Previous Academy Information</p>

                        <table class="table table-bordered mb-3">
                            <thead>
                                <tr>
                                    <th>Education</th>
                                    <th>Academy Name</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Group</th>
                                    <th>Roll</th>
                                    <th>Final Exam Result</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in rows" :key="index">
                                    <td>
                                        <select v-model="row.education" class="form-control">
                                            <option value="" disabled selected>Choose your education</option>
                                            <option v-for="priviouseducation in priviousEducations"
                                                :key="priviouseducation.id" :value="priviouseducation.education_name">
                                                {{ priviouseducation.education_name }}
                                            </option>
                                        </select>
                                    </td>

                                    <td>
                                        <input v-model="row.academy_name" type="text" class="form-control"
                                            placeholder="Enter Academy Name" />
                                    </td>
                                    <td>
                                        <input v-model="row.year" type="text" class="form-control"
                                            placeholder="Enter passing year" />
                                    </td>
                                    <td>
                                        <input v-model="row.class" type="text" class="form-control"
                                            placeholder="Enter class" />
                                    </td>
                                    <td>
                                        <input v-model="row.group" type="text" class="form-control"
                                            placeholder="Enter Group" />
                                    </td>
                                    <td>
                                        <input v-model="row.roll" type="text" class="form-control"
                                            placeholder="Enter Roll" />
                                    </td>
                                    <td>
                                        <input v-model="row.result" type="text" class="form-control"
                                            placeholder="Enter Result" />
                                    </td>
                                    <td class="text-center">
                                        <button v-if="index === rows.length - 1" @click="addRow"
                                            class="btn btn-success btn-sm">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <button v-if="rows.length > 1" @click="removeRow(index)"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="container mt-5">
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

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                        v-model="isChecked">
                                    <label class="form-check-label" for="exampleCheck1">Agree</label>
                                </div>
                            </div>
                        </div>

                        <div class="button-forgate d-flex justify-content-between w-100 align-items-center">
                            <button class="loginbutton btn btn-sm text-white fw-bold ms-auto">Next</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { onMounted, ref, computed } from "vue";
import { useRouter } from 'vue-router';
export default {
    name: "AdmissionForm",
    setup() {
        const token = localStorage.getItem("token");
        const student_id = localStorage.getItem('student_id')
        const router = useRouter();
        const classData = ref({});
        const Formnames = ref([]);
        const fields = ref([]);
        const termsAndConditions = ref('');
        const priviousEducations = ref([]);
        const academy_details = ref({});
        const isMobile = ref(false);
        const fileInput = ref(null);

        const signature = ref(null);
        const Picture = ref(null);
        const isChecked = ref(false);


        const onFileSelect = (event) => {
            const file = event.target.files[0];
            if (file.size > 1048576) {
                Toast.fire({
                    icon: "warning",
                    title: "Image must be less than 1 MB!",
                });
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    signature.value = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const onFileSelect2 = (event) => {
            const file = event.target.files[0];
            if (file.size > 1048576) {
                Toast.fire({
                    icon: "warning",
                    title: "Image must be less than 1 MB!",
                });
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    Picture.value = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

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

        const formatTime = (time) => {
            if (!time) return '';
            const [hours, minutes] = time.split(':');
            const hour12 = hours % 12 || 12;
            const amPm = hours >= 12 ? 'PM' : 'AM';
            return `${hour12}:${minutes} ${amPm}`;
        };

        const rows = ref([
            {
                id: 1,
                education: "",
                academy_name: "",
                year: "",
                class: "",
                group: "",
                roll: "",
                result: "",
            },
        ]);
        const addRow = () => {
            const newId = rows.value.length + 1;
            rows.value.push({
                id: newId,
                education: "",
                academy_name: "",
                year: "",
                class: "",
                group: "",
                roll: "",
                result: "",
            });
        };
        const removeRow = (index) => {
            rows.value.splice(index, 1);
        };

        const fetchClassData = async () => {
            try {
                const response = await axios.get("/api/admissionassign/findassign", {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
                if (response.data.id) {
                    classData.value = response.data;
                }
            } catch (error) {
                console.error("Error fetching class data:", error);
            }
        };
        const fetchForm = async () => {
            try {
                const response = await axios.get("/api/form-names/status/index");
                if (response.data && response.data.message) {
                    Formnames.value = response.data.data;
                }
            } catch (error) {
                console.error("Error fetching form names:", error);
            }
        };

        const fetchData = async () => {
            try {
                const response = await axios.get("/api/fields/status/index");
                if (response.data && response.data.message) {
                    fields.value = response.data.data;
                }
            } catch (error) {
                console.error("Error fetching fields data:", error);
            }
        };
        const getFieldsByFormId = (formId) => {
            return fields.value.filter((field) => field.form_name_id === formId);
        };
        const conditions = async () => {
            try {
                const response = await axios.get(`api/terms-condition`);
                if (response.data && response.data.message) {
                    termsAndConditions.value = response.data.data.content
                }
            } catch (error) {

            }
        }
        const splitTermsAndConditions = computed(() => {
            return termsAndConditions.value.split('.').filter(item => item.trim() !== '');
        });

        const previousEducation = async () => {
            try {
                const response = await axios.get(`/api/previous-educations`);
                if (response.data && response.data.message) {
                    priviousEducations.value = response.data.data
                }
            } catch (error) {
                console.log(error)
            }
        }

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

        const submitForm = async () => {

            const fieldValues = fields.value.map(field => field.value);
            const dynamicVariables = {};

            const customKey = 'class_id';
            dynamicVariables[customKey] = classData.value.id;

            if (signature.value !== undefined) {
                dynamicVariables.signature = signature.value;
            }
            if (Picture.value !== undefined) {
                dynamicVariables.Picture = Picture.value;
            }
            fieldValues.forEach((item, index) => {
                if (item !== undefined) {
                    const variableName = `fieldValues${index + 1}`;
                    dynamicVariables[variableName] = item;
                }
            });

            rows.value.forEach((row, index) => {
                dynamicVariables[`row${index + 1}`] = {
                    education: row.education,
                    academy_name: row.academy_name,
                    year: row.year,
                    class: row.class,
                    group: row.group,
                    roll: row.roll,
                    result: row.result,
                };
            });


            try {
                const response = await axios.post('/api/studentadmission/store', dynamicVariables,
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                        },
                    }
                );
                if (response.data && response.data.message) {
                    fields.value.forEach(field => {
                        field.value = "";
                    });
                    rows.value = rows.value.map(row => ({
                        ...row,
                        education: "",
                        academy_name: "",
                        year: "",
                        class: "",
                        group: "",
                        roll: "",
                        result: "",
                    }));
                    isChecked.value = false;
                    router.push({ name: 'AddmissionformView' });
                }
            } catch (error) {
                console.log(error)
            }
        }

        const Gohome = () => {
            localStorage.clear('token');
            localStorage.clear('student_id');
            router.push({ name: "HomeFront" })
        }
        const cleanedClassDetails = computed(() => {
            return classData.value.class_details
                ? classData.value.class_details.replace(/null>/g, '').replace(/>{2,}/g, '>').replace(/^>|>$/g, '') : '';
        });

        onMounted(() => {
            if (!token) {
                router.push({ name: "HomeFront" })
            }
            else {
                fetchClassData();
                fetchForm();
                fetchData();
                conditions();
                previousEducation();
                fetchAcademy(),
                    window.addEventListener("resize", checkScreenSize);
            }
        });

        return {
            Gohome,
            student_id,
            isChecked,
            signature,
            Picture,
            fileInput,
            onFileSelect,
            onFileSelect2,
            submitForm,
            rows,
            addRow,
            removeRow,
            token,
            fetchClassData,
            classData,
            fetchForm,
            Formnames,
            fetchData,
            fields,
            getFieldsByFormId,
            formatTime,
            conditions,
            termsAndConditions,
            splitTermsAndConditions,
            previousEducation,
            priviousEducations,
            fetchAcademy,
            formatAddress,
            isLongName,
            academy_details,
            isMobile,
            cleanedClassDetails,
        };
    },
};
</script>

<style scoped>
.onlineadmission {
    color: #5586c7;
}

.admissionfair {
    width: 100%;
    height: 10vh;
    background-color: #d00473;
    display: flex;
    align-items: center;
}

.academy-details p {
    line-height: 0.8;
    color: white;
}

.addmissionclass {
    color: #d00473;
}

.fee {
    color: #4ea49a;
}

.text_color {
    color: #b18ff5;
}

.studentinformation {
    color: #2865b8;
    font-weight: bold;
}

.loginbutton {
    background-color: #2865b8;
    border-radius: 15px;
    padding: 5px 15px;
}

.btnfor {
    border: none;
}

@media (max-width: 768px) {
    table thead {
        display: none;
    }

    table,
    thead,
    tbody,
    th,
    td,
    tr {
        display: block;
        width: 100%;
    }

    tr {
        margin-bottom: 10px;
    }

    td {
        text-align: center;
        /* Center the content in the td cell */
        position: relative;
        padding-left: 0;
    }

    td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
    }

}
</style>