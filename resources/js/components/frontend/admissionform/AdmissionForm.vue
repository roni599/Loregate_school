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
                                            <span v-if="field.required === 1 && !field.value" class="text-danger">
                                                This field is required.
                                            </span>
                                        </div>
                                        <!-- final -->
                                        <!-- <div v-else-if="field.field_type === 'select'">
                                            <select
                                                @change="(field.field_name === 'Division' || field.field_name === 'District' || field.field_name === 'Sub-District') ? handleSelectChange($event, form.name) : null"
                                                :id="field.field_name" :name="field.field_name"
                                                :required="field.required === 1" class="form-control"
                                                v-model="field.value">
                                                <option value="" disabled selected>Open this select menu</option>
                                                <option v-for="option in getFieldOptions(field, form.name)" :key="option"
                                                    :value="option">
                                                    {{ option }}
                                                </option>
                                            </select>
                                            <span v-if="field.required === 1 && !field.value" class="text-danger">
                                                This field is required.
                                            </span>
                                        </div> -->
                                        <div v-else-if="field.field_type === 'select'">
                                            <select
                                                @change="(field.field_name === 'Division' || field.field_name === 'District' || field.field_name === 'Sub-District') ? handleSelectChange($event, form.name) : null"
                                                :id="field.field_name" :name="field.field_name"
                                                :required="field.required === 1" class="form-select"
                                                v-model="field.value">
                                                <option value="" disabled selected>Open this select menu</option>
                                                <option v-for="option in getFieldOptions(field, form.name)"
                                                    :key="option" :value="option">
                                                    {{ option }}
                                                </option>
                                            </select>
                                            <span v-if="field.required === 1 && !field.value"
                                                class="text-danger mt-1 d-block">
                                                This field is required.
                                            </span>
                                        </div>



                                        <div v-else-if="field.field_type === 'date'">
                                            <input :type="field.field_type" :id="field.field_name"
                                                :name="field.field_name" :required="field.required === 1"
                                                class="form-control" v-model="field.value" />
                                            <span v-if="field.required === 1 && !field.value" class="text-danger">
                                                This field is required.
                                            </span>
                                        </div>
                                        <div v-else-if="field.field_type === 'email'">
                                            <input :type="field.field_type" :id="field.field_name"
                                                :name="field.field_name" :required="field.required === 1"
                                                class="form-control" v-model="field.value" />
                                            <span v-if="field.required === 1 && !field.value" class="text-danger">
                                                This field is required.
                                            </span>
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
                                                            <span v-if="field.required === 1 && !field.value"
                                                                class="text-danger">
                                                                This field is required.
                                                            </span>
                                                            <!-- <p v-if="errors2" class="error-message text-danger">{{
                                                                errors2
                                                                }}</p> -->
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
                                                            <span v-if="field.required === 1 && !field.value"
                                                                class="text-danger">
                                                                This field is required.
                                                            </span>
                                                            <!-- <p v-if="errors" class="error-message text-danger">{{ errors
                                                                }}</p> -->
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
        const formSubmitted = ref(false);
        const errors = ref("");
        const errors2 = ref("");
        const genders = ref([
            { id: 1, label: "Male" },
            { id: 2, label: "Female" },
            { id: 3, label: "Others" }
        ]);

        const divisions1 = ref([
            {
                id: 1,
                name: 'Dhaka',
                districts: [
                    {
                        name: 'Dhaka',
                        subDistricts: ["Dhamrai", "Dohar", "Keraniganj", "Nawabganj", "Savar", "Tejgaon Circle"],

                    },
                    {
                        name: 'Faridpur',
                        subDistricts: ["Alfadanga", "Bhanga", "Boalmari", "Charbhadrasan", "Faridpur Sadar", "Madhukhali", "Nagarkanda", "Sadarpur", "Saltha"],
                    },
                    {
                        name: 'Gazipur',
                        subDistricts: ["Gazipur Sadar", "Kaliakair", "Kaliganj", "Kapasia", "Sreepur"],
                    },
                    {
                        name: 'Gopalganj',
                        subDistricts: ["Gopalganj Sadar", "Kashiani", "Kotalipara", "Muksudpur", "Tungipara"],
                    },
                    {
                        name: 'Kishoreganj',
                        subDistricts: ["Austagram", "Bajitpur", "Bhairab", "Hossainpur", "Itna", "Karimganj", "Katiadi", "Kishoreganj Sadar", "Kuliarchar", "Mithamain", "Nikli", "Pakundia"],
                    },
                    {
                        name: 'Madaripur',
                        subDistricts: ["Rajoir", "Madaripur Sadar", "Kalkini", "Shibchar"],
                    },
                    {
                        name: 'Manikganj',
                        subDistricts: ["Daulatpur", "Ghior", "Harirampur", "Manikgonj Sadar", "Saturia", "Shivalaya", "Singair"],
                    },
                    {
                        name: 'Munshiganj',
                        subDistricts: ["Gazaria", "Lohajang", "Munshiganj Sadar", "Sirajdikhan", "Sreenagar", "Tongibari"],
                    },
                    {
                        name: 'Narayanganj',
                        subDistricts: ["Araihazar", "Bandar", "Narayanganj Sadar", "Rupganj", "Sonargaon"],
                    },
                    {
                        name: 'Narsingdi',
                        subDistricts: ["Narsingdi Sadar", "Belabo", "Monohardi", "Palash", "Raipura", "Shibpur"],
                    },
                    {
                        name: 'Rajbari',
                        subDistricts: ["Baliakandi", "Goalandaghat", "Pangsha", "Rajbari Sadar", "Kalukhali"],
                    },
                    {
                        name: 'Shariatpur',
                        subDistricts: ["Bhedarganj", "Damudya", "Gosairhat", "Naria", "Shariatpur Sadar", "Zajira", "Shakhipur"],
                    },
                    {
                        name: 'Tangail',
                        subDistricts: ["Gopalpur", "Basail", "Bhuapur", "Delduar", "Ghatail", "Kalihati", "Madhupur", "Mirzapur", "Nagarpur", "Sakhipur", "Dhanbari", "Tangail Sadar"],
                    },

                ]

            },
            {
                id: 2,
                name: 'Chattogram',
                districts: [
                    {
                        name: 'Bandarban',
                        subDistricts: ["Ali Kadam", "Bandarban Sadar", "Lama", "Naikhongchhari", "Rowangchhari", "Ruma", "Thanchi"],
                    },
                    {
                        name: 'Brahmanbaria',
                        subDistricts: ["Akhaura", "Bancharampur", "Brahmanbaria Sadar", "Kasba", "Nabinagar", "Nasirnagar", "Sarail", "Ashuganj", "Bijoynagar"],
                    },
                    {
                        name: 'Chandpur',
                        subDistricts: ["Chandpur Sadar", "Faridganj", "Haimchar", "Haziganj", "Kachua", "Matlab Dakshin", "Matlab Uttar", "Shahrasti"],
                    },
                    {
                        name: 'Chittagong',
                        subDistricts: ["Anwara", "Banshkhali", "Boalkhali", "Chandanaish", "Fatikchhari", "Hathazari", "Karnaphuli", "Lohagara", "Mirsharai", "Patiya", "Rangunia", "Raozan", "Sandwip", "Satkania", "Sitakunda", "Bandar Thana", "Chandgaon Thana", "Double Mooring Thana", "Kotwali Thana", "Pahartali Thana", "Panchlaish Thana", "Bhujpur Thana"],
                    },
                    {
                        name: 'Comilla',
                        subDistricts: ["Barura", "Brahmanpara", "Burichang", "Chandina", "Chauddagram", "Daudkandi", "Debidwar", "Homna", "Laksam", "Muradnagar", "Nangalkot", "Cumilla Adarsha Sadar", "Meghna", "Titas", "Monohargonj", "Cumilla Sadar Dakshin"],
                    },
                    {
                        name: "Cox's Bazar",
                        subDistricts: ["Chakaria", "Cox's Bazar Sadar", "Kutubdia", "Maheshkhali", "Ramu", "Teknaf", "Ukhia", "Pekua"],
                    },
                    {
                        name: "Feni",
                        subDistricts: ["Chhagalnaiya", "Daganbhuiyan", "Feni Sadar", "Parshuram", "Sonagazi", "Fulgazi"],
                    },
                    {
                        name: "Khagrachhari",
                        subDistricts: ["Dighinala", "Khagrachhari", "Lakshmichhari", "Mahalchhari", "Manikchhari", "Matiranga", "Panchhari", "Ramgarh"],
                    },
                    {
                        name: "Lakshmipur",
                        subDistricts: ["Lakshmipur Sadar", "Raipur", "Ramganj", "Ramgati", "Kamalnagar"],
                    },
                    {
                        name: "Noakhali",
                        subDistricts: ["Begumganj", "Noakhali Sadar", "Chatkhil", "Companiganj", "Hatiya", "Senbagh", "Sonaimuri", "Subarnachar", "Kabirhat"],
                    },
                    {
                        name: "Rangamati",
                        subDistricts: ["Bagaichhari", "Barkal", "Kawkhali (Betbunia)", "Belaichhari", "Kaptai", "Juraichhari", "Langadu", "Naniyachar", "Rajasthali", "Rangamati Sadar"],
                    },
                ],
            },
            {
                id: 3,
                name: 'Barisal',
                districts: [
                    {
                        name: 'Barguna',
                        subDistricts: ["Amtali", "Bamna", "Barguna Sadar", "Betagi", "Patharghata", "Taltali"],
                    },
                    {
                        name: 'Barisal',
                        subDistricts: ["Agailjhara", "Babuganj", "Bakerganj", "Banaripara", "Gaurnadi", "Hizla", "Barishal Sadar", "Mehendiganj", "Muladi", "Wazirpur"],
                    },
                    {
                        name: 'Bhola',
                        subDistricts: ["Bhola Sadar", "Burhanuddin", "Char Fasson", "Daulatkhan", "Lalmohan", "Manpura", "Tazumuddin"],
                    },
                    {
                        name: 'Jhalokati',
                        subDistricts: ["Jhalokati Sadar", "Kathalia", "Nalchity", "Rajapur"],
                    },
                    {
                        name: 'Patuakhali',
                        subDistricts: ["Bauphal", "Dashmina", "Galachipa", "Kalapara", "Mirzaganj", "Patuakhali Sadar", "Rangabali", "Dumki"],
                    },
                    {
                        name: "Pirojpur",
                        subDistricts: ["Bhandaria", "Kawkhali", "Mathbaria", "Nazirpur", "Pirojpur Sadar", "Nesarabad (Swarupkati)", "Zianagar"],
                    },
                ],
            },
            {
                id: 4,
                name: 'Khulna',
                districts: [
                    {
                        name: 'Bagerhat',
                        subDistricts: ["Bagerhat Sadar", "Chitalmari", "Fakirhat", "Kachua", "Mollahat", "Mongla", "Morrelganj", "Rampal", "Sarankhola"],
                    },
                    {
                        name: 'Chuadanga',
                        subDistricts: ["Alamdanga", "Chuadanga Sadar", "Damurhuda", "Jibannagar"],
                    },
                    {
                        name: 'Jessore',
                        subDistricts: ["Abhaynagar", "Bagherpara", "Chaugachha", "Jhikargachha", "Keshabpur", "Jashore Sadar", "Manirampur", "Sharsha"],
                    },
                    {
                        name: 'Jhenaidah',
                        subDistricts: ["Harinakunda", "Jhenaidah Sadar", "Kaliganj", "Kotchandpur", "Maheshpur", "Shailkupa"],
                    },
                    {
                        name: 'Khulna',
                        subDistricts: ["Batiaghata", "Dacope", "Dumuria", "Dighalia", "Koyra", "Paikgachha", "Phultala", "Rupsha", "Terokhada", "Daulatpur Thana", "Khalishpur Thana", "Khan Jahan Ali Thana", "Kotwali Thana", "Sonadanga Thana", "Harintana Thana"],
                    },
                    {
                        name: "Kushtia",
                        subDistricts: ["Bheramara", "Daulatpur", "Khoksa", "Kumarkhali", "Kushtia Sadar", "Mirpur"],
                    },
                    {
                        name: "Magura",
                        subDistricts: ["Magura Sadar", "Mohammadpur", "Shalikha", "Sreepur"],
                    },
                    {
                        name: "Meherpur",
                        subDistricts: ["Gangni", "Meherpur Sadar", "Mujibnagar"],
                    },
                    {
                        name: "Narail",
                        subDistricts: ["Kalia", "Lohagara", "Narail Sadar", "Naragati Thana"],
                    },
                    {
                        name: "Satkhira",
                        subDistricts: ["Assasuni", "Debhata", "Kalaroa", "Kaliganj", "Satkhira Sadar", "Shyamnagar", "Tala"],
                    },
                ],
            },
            {
                id: 5,
                name: 'Mymensingh',
                districts: [
                    {
                        name: 'Jamalpur',
                        subDistricts: ["Baksiganj", "Dewanganj", "Islampur", "Jamalpur Sadar", "Madarganj", "Melandaha", "Sarishabari"],
                    },
                    {
                        name: 'Mymensingh',
                        subDistricts: ["Trishal", "Dhobaura", "Fulbaria", "Gaffargaon", "Gauripur", "Haluaghat", "Ishwarganj", "Mymensingh Sadar", "Muktagachha", "Nandail", "Phulpur", "Bhaluka", "Tara Khanda"],
                    },
                    {
                        name: 'Netrakona',
                        subDistricts: ["Atpara", "Barhatta", "Durgapur", "Khaliajuri", "Kalmakanda", "Kendua", "Madan", "Mohanganj", "Netrokona Sadar", "Purbadhala"],
                    },
                    {
                        name: 'Sherpur',
                        subDistricts: ["Jhenaigati", "Nakla", "Nalitabari", "Sherpur Sadar", "Sreebardi"],
                    },
                ],
            },
            {
                id: 6,
                name: 'Rajshahi',
                districts: [
                    {
                        name: 'Bogra',
                        subDistricts: ["Adamdighi", "Bogura Sadar", "Dhunat", "Dhupchanchia", "Gabtali", "Kahaloo", "Nandigram", "Sariakandi", "Shajahanpur", "Sherpur", "Shibganj", "Sonatola"],
                    },
                    {
                        name: 'Chapainawabganj',
                        subDistricts: ["Bholahat", "Gomastapur", "Nachole", "Nawabganj Sadar", "Shibganj"],
                    },
                    {
                        name: 'Joypurhat',
                        subDistricts: ["Akkelpur", "Joypurhat Sadar", "Kalai", "Khetlal", "Panchbibi"],
                    },
                    {
                        name: 'Naogaon',
                        subDistricts: ["Atrai", "Badalgachhi", "Manda", "Dhamoirhat", "Mohadevpur", "Naogaon Sadar", "Niamatpur", "Patnitala", "Porsha", "Raninagar", "Sapahar"],
                    },
                    {
                        name: 'Natore',
                        subDistricts: ["Bagatipara", "Baraigram", "Gurudaspur", "Lalpur", "Natore Sadar", "Singra", "Naldanga"],
                    },
                    {
                        name: 'Pabna',
                        subDistricts: ["Atgharia", "Bera", "Bhangura", "Chatmohar", "Faridpur", "Ishwardi", "Pabna Sadar", "Santhia", "Sujanagar"],
                    },
                    {
                        name: 'Rajshahi',
                        subDistricts: ["Bagha", "Bagmara", "Charghat", "Durgapur", "Godagari", "Mohanpur", "Paba", "Puthia", "Tanore"],
                    },
                    {
                        name: 'Sirajganj',
                        subDistricts: ["Belkuchi", "Chauhali", "Kamarkhanda", "Kazipur", "Raiganj", "Shahjadpur", "Sirajganj Sadar", "Tarash", "Ullahpara"],
                    },
                ],
            },
            {
                id: 7,
                name: 'Rangpur',
                districts: [
                    {
                        name: 'Dinajpur',
                        subDistricts: ["Birampur", "Birganj", "Biral", "Bochaganj", "Chirirbandar", "Phulbari", "Ghoraghat", "Hakimpur", "Kaharole", "Khansama", "Dinajpur Sadar", "Nawabganj", "Parbatipur"],
                    },
                    {
                        name: 'Gaibandha',
                        subDistricts: ["Phulchhari", "Gaibandha Sadar", "Gobindaganj", "Palashbari", "Sadullapur", "Sughatta", "Sundarganj"],
                    },
                    {
                        name: 'Kurigram',
                        subDistricts: ["Bhurungamari", "Char Rajibpur", "Chilmari", "Phulbari", "Kurigram Sadar", "Nageshwari", "Rajarhat", "Raomari", "Ulipur"],
                    },
                    {
                        name: 'Lalmonirhat',
                        subDistricts: ["Aditmari", "Hatibandha", "Kaliganj", "Lalmonirhat Sadar", "Patgram"],
                    },
                    {
                        name: 'Nilphamari',
                        subDistricts: ["Dimla", "Domar", "Jaldhaka", "Kishoreganj", "Nilphamari Sadar", "Saidpur"],
                    },
                    {
                        name: 'Panchagarh',
                        subDistricts: ["Atwari", "Boda", "Debiganj", "Panchagarh Sadar", "Tetulia"],
                    },
                    {
                        name: 'Rangpur',
                        subDistricts: ["Badarganj", "Gangachhara", "Kaunia", "Rangpur Sadar", "Mithapukur", "Pirgachha", "Pirganj", "Taraganj"],
                    },
                    {
                        name: 'Thakurgaon',
                        subDistricts: ["Baliadangi", "Haripur", "Pirganj", "Ranisankail", "Thakurgaon Sadar"],
                    },
                ],
            },
            {
                id: 8,
                name: 'Rangpur',
                districts: [
                    {
                        name: 'Habiganj',
                        subDistricts: ["Ajmiriganj", "Bahubal", "Baniyachong", "Chunarughat", "Habiganj Sadar", "Lakhai", "Madhabpur", "Nabiganj", "Sayestaganj"],
                    },
                    {
                        name: 'Moulvibazar',
                        subDistricts: ["Barlekha", "Juri", "Kamalganj", "Kulaura", "Moulvibazar Sadar", "Rajnagar", "Sreemangal"],
                    },
                    {
                        name: 'Sunamganj',
                        subDistricts: ["Bishwamvarpur", "Chhatak", "Dakshin Sunamganj", "Derai", "Dharamapasha", "Dowarabazar", "Jagannathpur", "Jamalganj", "Sullah", "Sunamganj Sadar", "Tahirpur"],
                    },
                    {
                        name: 'Sylhet',
                        subDistricts: ["Balaganj", "Beanibazar", "Bishwanath", "Companigonj", "Dakshin Surma", "Fenchuganj", "Golapganj", "Gowainghat", "Jaintiapur", "Kanaighat", "Osmani Nagar", "Sylhet Sadar", "Zakiganj"]
                    },
                ],
            },
        ]);

        const divisions2 = ref([
            {
                id: 1,
                name: 'Dhaka',
                districts: [
                    {
                        name: 'Dhaka',
                        subDistricts: ['Kfjdk', 'Jfsdlk', 'Kfjsdl'],
                    },
                    {
                        name: 'Faridpur',
                        subDistricts: ['Sub-district 1', 'Sub-district 2'],
                    },
                    {
                        name: 'Gazipur',
                        subDistricts: ['Sub-district A', 'Sub-district B'],
                    },
                    {
                        name: 'Gopalganj',
                        subDistricts: ['Sub-district X', 'Sub-district Y'],
                    },
                ],
            },
            {
                id: 2,
                name: 'Chattogram',
                districts: [
                    {
                        name: 'Bandarban',
                        subDistricts: ['Sub-district Z', 'Sub-district W'],
                    },
                    {
                        name: 'Brahmanbaria',
                        subDistricts: ['Sub-district M', 'Sub-district N'],
                    },
                    {
                        name: 'Chandpur',
                        subDistricts: ['Sub-district K', 'Sub-district L'],
                    },
                ],
            },
        ]);

        const selectedDivision = ref(null);
        const selectedDistrict = ref(null);
        const selectedDivision2 = ref(null);
        const selectedDistrict2 = ref(null);
        const selectedGender = ref(null); // Selected gender

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
        // const onFileSelect = (event) => {
        //     const file = event.target.files[0];
        //     if (!file) {
        //         errors.value = "No file selected!";
        //         return;
        //     }
        //     errors.value = "";
        //     if (file.size > 1048576) {
        //         errors.value = "Image must be less than 1 MB!";
        //         return;
        //     }
        //     const reader = new FileReader();
        //     reader.onload = (e) => {
        //         const img = new Image();
        //         img.onload = () => {
        //             if (img.width === 450 && img.height === 600) {
        //                 signature.value = e.target.result;
        //                 errors.value = "";
        //             } else {
        //                 errors.value = "Image must be 450px by 450px!";
        //             }
        //         };
        //         img.src = e.target.result;
        //     };
        //     reader.readAsDataURL(file);
        // };

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

        // const onFileSelect2 = (event) => {
        //     const file = event.target.files[0];
        //     if (!file) {
        //         errors2.value = "No file selected!";
        //         return;
        //     }
        //     errors2.value = "";

        //     if (file.size > 1048576) {
        //         errors2.value = "Image must be less than 1 MB!";
        //         return;
        //     }
        //     const reader = new FileReader();
        //     reader.onload = (e) => {
        //         const img = new Image();
        //         img.onload = () => {
        //             if (img.width === 450 && img.height === 600) {
        //                 Picture.value = e.target.result;
        //                 errors2.value = "";
        //             } else {
        //                 errors2.value = "Image must be 450px by 450px!";
        //             }
        //         };
        //         img.src = e.target.result;
        //     };
        //     reader.readAsDataURL(file);
        // };

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
            formSubmitted.value = true;
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

            console.log(dynamicVariables);


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
            const token = localStorage.getItem('token');
            const user = localStorage.getItem('user');
            const student_id = localStorage.getItem('student_id');
            if (token && user) {
                router.push({ name: "BackHome" });
            }
            else if (token && student_id) {
                fetchClassData();
                fetchForm();
                fetchData();
                conditions();
                previousEducation();
                fetchAcademy(),
                    window.addEventListener("resize", checkScreenSize);
            }
            else {
                router.push({ name: "HomeFront" });
            }

        });

        const getFieldOptions = (field, form_Address) => {
            if (field.field_name === "Division" && form_Address === "Present Address") {
                return divisions1.value.map(division => division.name);
            }
            else if (field.field_name === "Division" && form_Address === "Permanent Address") {
                return divisions1.value.map(division => division.name);
            }

            else if (field.field_name === "District" && form_Address === "Present Address") {
                if (!selectedDivision.value) return [];
                const division = divisions1.value.find(d => d.name === selectedDivision.value);
                return division ? division.districts.map(district => district.name) : [];
            }
            else if (field.field_name === "District" && form_Address === "Permanent Address") {
                if (!selectedDivision2.value) return [];
                const division = divisions1.value.find(d => d.name === selectedDivision2.value);
                return division ? division.districts.map(district => district.name) : [];
            }
            else if (field.field_name === "Sub-District" && form_Address === "Present Address") {
                if (!selectedDistrict.value) return [];
                const division = divisions1.value.find(d => d.name === selectedDivision.value);
                const district = division ? division.districts.find(d => d.name === selectedDistrict.value) : null;
                return district ? district.subDistricts : [];
            }
            else if (field.field_name === "Sub-District" && form_Address === "Permanent Address") {
                if (!selectedDistrict2.value) return [];
                const division = divisions1.value.find(d => d.name === selectedDivision2.value);
                const district = division ? division.districts.find(d => d.name === selectedDistrict2.value) : null;
                return district ? district.subDistricts : [];
            }
            else if (field.field_name === 'Gender') {
                return genders.value.map(gender => gender.label);
            }
        };

        const handleSelectChange = (event, form_name) => {
            const fieldName = event.target.name;
            if (fieldName === "Division" && form_name === 'Present Address') {
                selectedDivision.value = event.target.value;
                selectedDistrict.value = null;
            }
            if (fieldName === "Division" && form_name === 'Permanent Address') {
                selectedDivision2.value = event.target.value;
                selectedDistrict2.value = null;
            }
            else if (fieldName === "District" && form_name === 'Permanent Address') {
                selectedDistrict2.value = event.target.value;
            }
            else if (fieldName === "District" && form_name === 'Present Address') {
                selectedDistrict.value = event.target.value;
            }
        };

        return {
            handleSelectChange,
            getFieldOptions,
            selectedGender,
            selectedDistrict,
            selectedDivision,
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
            formSubmitted,
            errors,
            errors2,
            genders,
            divisions1,
            divisions2
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