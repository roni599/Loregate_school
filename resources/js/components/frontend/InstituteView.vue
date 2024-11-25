<template>
    <div class="container text-center mb-4 d-none d-md-block">
        <!-- Desktop Layout with Column Structure -->
        <div class="row">
            <div class="col-md-3 d-flex flex-column align-items-center mb-4">
                <div class="education_minister mb-3">
                    <div class="education_minister_name mb-2">
                        <p>{{ educationBoard.edesignation }}</p>
                    </div>
                    <div class="education_minister_picture mb-2">
                        <img v-if="educationBoard.e_image"
                            :src="`/backend/images/educationboard/${educationBoard.e_image}`" width="150"
                            alt="Education Minister">
                    </div>
                    <div class="education_minister_name_details">
                        <p>{{ educationBoard.eminister_name }}</p>
                    </div>
                </div>
                <div class="prime_minister mb-3">
                    <div class="prime_minister_name mb-2">
                        <p>{{ primePresedent.prime_minister_designation }}</p>
                    </div>
                    <div class="prime_minister_picture mb-2">
                        <img v-if="primePresedent.prime_minister_image"
                            :src="`/backend/images/primepresedent/${primePresedent.prime_minister_image}`" width="150"
                            alt="Prime Minister">
                    </div>
                    <div class="education_minister_name_details">
                        <p>{{ primePresedent.prime_minister_name }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="institute_history mb-3">
                    <div class="institute_history_heading mb-3 mt-5 fw-bold fs-5">
                        <a href="#" class="text-dark">প্রতিষ্ঠানের ইতিহাস</a>
                    </div>
                    <div class="institute_history_details mt-5">
                        <p class="mb-5">
                            {{ history }}
                            <button v-if="fullHistory.length > 10" class="btn btn-link p-0 ms-2" @click="toggleModal">
                                Show More
                            </button>
                        </p>

                    </div>
                </div>
            </div>

            <div class="col-md-3 d-flex flex-column align-items-center mb-4">
                <div class="education_minister mb-3">
                    <div class="education_minister_name mb-2">
                        <p>{{ educationBoard.bdesignation }}</p>
                    </div>
                    <div class="education_minister_picture mb-2">
                        <img v-if="educationBoard.b_image"
                            :src="`/backend/images/educationboard/${educationBoard.b_image}`" width="150"
                            alt="Board Chairman">
                    </div>
                    <div class="education_minister_name_details">
                        <p>{{ educationBoard.bminister_name }}</p>
                    </div>
                </div>
                <div class="prime_minister mb-3">
                    <div class="prime_minister_name mb-2">
                        <p>{{ primePresedent.president_designation }}</p>
                    </div>
                    <div class="prime_minister_picture mb-2">
                        <img v-if="primePresedent.president_image"
                            :src="`/backend/images/primepresedent/${primePresedent.president_image}`" width="150"
                            alt="President">
                    </div>
                    <div class="education_minister_name_details">
                        <p>{{ primePresedent.president_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Layout (shown only on mobile screens) -->
    <div class="institutute_history_div container d-flex flex-column align-items-center text-center d-md-none mb-2">
        <div class="education_minister_name mb-2">
            <p>{{ educationBoard.edesignation }}</p>
        </div>
        <div class="education_minister mb-3">
            <div class="education_minister_picture">
                <img v-if="educationBoard.e_image" :src="`/backend/images/educationboard/${educationBoard.e_image}`"
                    width="150" alt="Education Minister">
            </div>
            <div class="education_minister_name_details">
                <p>{{ educationBoard.eminister_name }}</p>
            </div>
        </div>

        <div class="prime_minister_name mb-2">
            <p>{{ primePresedent.prime_minister_designation }}</p>
        </div>
        <div class="prime_minister mb-3">
            <div class="prime_minister_picture">
                <img v-if="primePresedent.prime_minister_image"
                    :src="`/backend/images/primepresedent/${primePresedent.prime_minister_image}`" width="150"
                    alt="Prime Minister">
            </div>
            <div class="education_minister_name_details">
                <p>{{ primePresedent.prime_minister_name }}</p>
            </div>
        </div>

        <div class="institute_history_heading  fw-bold fs-5">
            <a href="#" class="text-dark">প্রতিষ্ঠানের ইতিহাস</a>
        </div>

        <div class="institute_history_details mb-4">
            <p class="mb-5">
                {{ history }}
                <button v-if="fullHistory.length > 10" class="btn btn-link p-0 ms-2" @click="toggleModal">
                    Show More
                </button>
            </p>
        </div>
        <div class="education_minister mb-3">
            <div class="education_minister_name mb-2">
                <p>{{ educationBoard.bdesignation }}</p>
            </div>
            <div class="education_minister_picture">
                <img v-if="educationBoard.b_image" :src="`/backend/images/educationboard/${educationBoard.b_image}`"
                    width="150" alt="Board Chairman">
            </div>
            <div class="education_minister_name_details">
                <p>{{ educationBoard.bminister_name }}</p>
            </div>
        </div>
        <div class="prime_minister_name mb-2">
            <p>{{ primePresedent.president_designation }}</p>
        </div>
        <div class="prime_minister mb-3">
            <div class="prime_minister_picture">
                <img v-if="primePresedent.president_image"
                    :src="`/backend/images/primepresedent/${primePresedent.president_image}`" width="150"
                    alt="President">
            </div>
            <div class="education_minister_name_details">
                <p>{{ primePresedent.president_name }}</p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5> -->
                    <button type="button" class="btn-close d-flex justify-content-end" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="container py-5 Academy_details">
                        <h4 class="text-center mb-4">Academy</h4>
                        <div class="academydiv_hr_rule d-flex justify-center align-items-end">
                            <div class="academydiv">Academy Details</div>
                            <div class="hr_rule"></div>
                        </div>
                        <div class="texttag container py-5">
                            <p> {{ fullHistory }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    name: "Instituteview",
    setup() {
        const academy_id = ref(1);
        const educationBoard = ref({});
        const primePresedent = ref({});
        const firstPart = ref('');
        const secondPart = ref('');
        const history = ref('');
        const fullHistory = ref('');

        const educationBoardData = async () => {
            const response = await axios.get(`/api/academy/education-board`)
            if (response.data.data) {
                educationBoard.value = response.data.data
            }
        }

        const primePresedentData = async () => {
            const response = await axios.get(`/api/academy/prime-presedent`)
            if (response.data.data) {
                primePresedent.value = response.data.data
            }
        }

        const academyHistoryData = async () => {
            const response = await axios.get(`/api/academy/history`);
            if (response.data.data) {
                fullHistory.value = response.data.data.history;
                const words = fullHistory.value.split(' ');
                if (words.length > 200) {
                    history.value = `${words.slice(0, 200).join(' ')}`;
                } else {
                    history.value = words.join(' ');
                }
            }
        }
        onMounted(() => {
            educationBoardData(),
                primePresedentData(),
                academyHistoryData()
        })

        const toggleModal = () => {
            const modal = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
            modal.show();
        }
        return {
            academy_id,
            educationBoard,
            primePresedent,
            firstPart,
            secondPart,
            educationBoardData,
            primePresedentData,
            academyHistoryData,
            history,
            fullHistory,
            toggleModal
        }
    }
}
</script>

<style scoped>
.academydiv {
    width: 190px;
    background-color: red;
    text-align: center;
    padding: 5px;
    color: white;
}

.hr_rule {
    width: 100%;
    height: 2px;
    padding: 2px;
    background-color: rgb(29, 6, 233);
}

.texttag {
    text-align: justify;
}
</style>