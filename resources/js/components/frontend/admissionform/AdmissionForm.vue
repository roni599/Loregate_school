<template>
    <div class="main-div">
        <div class="container-fluid admissionfair">
            <div class="contentload w-100 d-flex justify-content-between align-items-center">
                <!-- Left Content -->
                <div class="content-image-academy-details d-flex align-items-center w-75">
                    <router-link to="/" class="academy-image me-3">
                        <img v-if="academy_details.academy_logo"
                            :src="`/backend/images/academy/${academy_details.academy_logo}`" width="45" height="45"
                            class="rounded-circle me-2" alt="Academy Logo">
                    </router-link>
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
                <div class="admissionfaircontent d-flex justify-content-end align-items-center w-25">
                    <h1 class="text-white fw-bold me-4">ভর্তি মেলা</h1>
                </div>
            </div>
        </div>
        <div class="details_time d-flex justify-content-between align-items-center container">
            <h6 class="text-center fw-bold py-3 onlineadmission mx-auto">
                Online Admission Form
            </h6>
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
                    <p class="mb-2">
                        <span class="addmissionclass fw-bold">Admission Class </span> :
                        {{ classData.class_name }}>{{ classData.class_details }}
                    </p>
                    <p class="fee fw-bold mb-4">Fee: {{ classData.fee }}</p>
                    <form action="" class="">
                        <div class="formName mb-3" v-for="form in Formnames" :key="form.id">
                            <p class="studentinformation">{{ form.name }}</p>
                            <div class="row">
                                <div class="col-md-4 mb-2" v-for="field in getFieldsByFormId(form.id)" :key="field.id">
                                    <div class="inputfield">
                                        <label :for="field.field_name">{{ field.field_name }}</label>
                                        <div v-if="field.field_type === 'text'">
                                            <input :type="field.field_type" :id="field.field_name"
                                                :name="field.field_name" :required="field.required === 1"
                                                class="form-control" />
                                        </div>
                                        <div v-else-if="field.field_type === 'select'">
                                            <select :id="field.field_name" :name="field.field_name"
                                                :required="field.required === 1" class="form-control">
                                                <option value="" disabled selected>Open this select menu</option>
                                                <option v-for="option in field.options" :key="option" :value="option">
                                                    {{ option }}
                                                </option>
                                            </select>
                                        </div>
                                        <div v-else-if="field.field_type === 'date'">
                                            <input :type="field.field_type" :id="field.field_name"
                                                :name="field.field_name" :required="field.required === 1"
                                                class="form-control" />
                                        </div>
                                        <div v-else-if="field.field_type === 'email'">
                                            <input :type="field.field_type" :id="field.field_name"
                                                :name="field.field_name" :required="field.required === 1"
                                                class="form-control" />
                                        </div>

                                        <div v-else-if="field.field_type === 'file'">
                                            <!-- Picture Input -->
                                            <div v-if="field.field_name === 'Picture'" class="container mt-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-center text-center">
                                                            <div>
                                                                <img src="../../../../../public/frontend/images/image.png"
                                                                    @click="$refs.pictureInput.click()" alt="Picture"
                                                                    width="50" height="50" style="cursor: pointer" />
                                                                <input :type="field.field_type" ref="pictureInput"
                                                                    id="pictureInput" name="picture"
                                                                    :required="field.required === 1"
                                                                    class="form-control" style="display: none"
                                                                    @change="handleFileChange($event, 'picture')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Signature Input -->
                                            <div v-if="field.field_name === 'Signature'" class="container mt-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex justify-content-center text-center">
                                                            <div>
                                                                <img src="../../../../../public/frontend/images/digital-signature.png"
                                                                    @click="$refs.signatureInput.click()"
                                                                    alt="Signature" width="50" height="50"
                                                                    style="cursor: pointer" />
                                                                <input :type="field.field_type" ref="signatureInput"
                                                                    id="signatureInput" name="signature"
                                                                    :required="field.required === 1"
                                                                    class="form-control" style="display: none" @change="
                                                                        handleFileChange($event, 'signature')
                                                                        " />
                                                            </div>
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
                                <tr v-for="(row, index) in rows" :key="row.id">
                                    <td>
                                        <select v-model="row.column1" class="form-control">
                                            <option value="" disabled selected>Choose your education</option>
                                            <option v-for="priviouseducation in priviousEducations"
                                                :key="priviouseducation.id" :value="priviouseducation.education_name">
                                                {{ priviouseducation.education_name }}
                                            </option>
                                        </select>
                                    </td>

                                    <td>
                                        <input v-model="row.column2" type="text" class="form-control"
                                            placeholder="Enter Academy Name" />
                                    </td>
                                    <td>
                                        <input v-model="row.column3" type="text" class="form-control"
                                            placeholder="Enter passing year" />
                                    </td>
                                    <td>
                                        <input v-model="row.column4" type="text" class="form-control"
                                            placeholder="Enter class" />
                                    </td>
                                    <td>
                                        <input v-model="row.column5" type="text" class="form-control"
                                            placeholder="Enter Group" />
                                    </td>
                                    <td>
                                        <input v-model="row.column6" type="text" class="form-control"
                                            placeholder="Enter Roll" />
                                    </td>
                                    <td>
                                        <input v-model="row.column7" type="text" class="form-control"
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
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Agree</label>
                                </div>
                            </div>
                        </div>
                        <div class="button-forgate d-flex justify-content-between w-100 align-items-center">
                            <router-link to="/admissionformview" type="submit"
                                class="loginbutton btn btn-sm text-white fw-bold ms-auto">Next</router-link>
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
export default {
    name: "AdmissionForm",
    setup() {
        const token = localStorage.getItem("token");
        const classData = ref({});
        const Formnames = ref([]);
        const fields = ref([]);
        const termsAndConditions = ref('');
        const priviousEducations = ref([]);
        const academy_details = ref({});
        const isMobile = ref(false);

        const fetchAcademy = async () => {
            try {
                const response = await axios.get(`/api/academy/header`);
                console.log(response)
                if (response.data?.data) {
                    academy_details.value = response.data.data;

                    // Set document title and favicon
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
                column1: "",
                column2: "",
                column3: "",
                column4: "",
                column5: "",
                column6: "",
                column7: "",
            },
        ]);
        const addRow = () => {
            const newId = rows.value.length + 1;
            rows.value.push({
                id: newId,
                column1: "",
                column2: "",
                column3: "",
                column4: "",
                column5: "",
                column6: "",
                column7: "",
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
                    console.log(termsAndConditions.value)
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
            isMobile.value = window.innerWidth <= 768; // Mobile breakpoint
        };
        onMounted(() => {
            fetchClassData();
            fetchForm();
            fetchData();
            conditions();
            previousEducation();
            fetchAcademy(),
                window.addEventListener("resize", checkScreenSize);
        });
        return {
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
            isMobile
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
    display: flex; /* Flex container for vertical alignment */
    align-items: center; /* Vertical alignment */
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