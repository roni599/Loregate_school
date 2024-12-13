<template>
    <div class="container text-center mb-4 d-none d-md-block">
        <div class="row">
            <div class="col-md-3 d-flex flex-column align-items-center mb-4">
                <div class="prime_minister mb-3">
                    <div class="prime_minister_name mb-2 prime_color">
                        <p>{{ primePresedent.prime_minister_designation }}</p>
                    </div>
                    <div class="prime_minister_picture mb-2">
                        <img v-if="primePresedent.prime_minister_image"
                            :src="`/backend/images/primepresedent/${primePresedent.prime_minister_image}`" width="150"
                            height="200px" alt="Prime Minister">
                    </div>
                    <div class="education_minister_name_details">
                        <p>{{ primePresedent.prime_minister_name }}</p>
                    </div>
                </div>

                <div class="education_minister mb-3">
                    <div class="education_minister_name ms-4 mb-2 prime_color">
                        <p>{{ educationBoard.edesignation }}</p>
                    </div>
                    <div class="education_minister_picture mb-2 me-3">
                        <img v-if="educationBoard.e_image"
                            :src="`/backend/images/educationboard/${educationBoard.e_image}`" width="150" height="200px"
                            alt="Education Minister">
                    </div>
                    <div class="education_minister_name_details">
                        <p>{{ educationBoard.eminister_name }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="institute_history mb-3">
                    <div class="institute_history_heading mt-4 fw-bold fs-5">
                        <a href="#" class="text-dark">প্রতিষ্ঠানের ইতিহাস</a>
                    </div>
                    <div class="institute_history_details">
                        <p class="">
                            {{ history }}
                            <button v-if="fullHistory.length > 10" class="btn btn-link p-0 ms-2 showmore"
                                @click="toggleModal">
                                Show More
                            </button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex flex-column align-items-center mb-4">
                <div class="prime_minister mb-3">
                    <div class="prime_minister_name mb-2 prime_color">
                        <p>{{ primePresedent.president_designation }}</p>
                    </div>
                    <div class="prime_minister_picture mb-2">
                        <img v-if="primePresedent.president_image"
                            :src="`/backend/images/primepresedent/${primePresedent.president_image}`" width="150"
                            height="200px" alt="President">
                    </div>
                    <div class="education_minister_name_details">
                        <p>{{ primePresedent.president_name }}</p>
                    </div>
                </div>
                <div class="education_minister mb-3">
                    <div class="education_minister_name mb-2 prime_color">
                        <p>{{ educationBoard.bdesignation }}</p>
                    </div>
                    <div class="education_minister_picture mb-2">
                        <img v-if="educationBoard.b_image"
                            :src="`/backend/images/educationboard/${educationBoard.b_image}`" width="150" height="200px"
                            alt="Board Chairman">
                    </div>
                    <div class="education_minister_name_details">
                        <p>{{ educationBoard.bminister_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="institutute_history_div container d-flex flex-column align-items-center text-center d-md-none mb-2">
        <div class="d-flex flex-wrap justify-content-between w-100">
            <div class="prime_minister d-flex align-items-center w-50">
                <div class="prime_minister_name prime_color w-100 mb-2">
                    <p>{{ primePresedent.prime_minister_designation }}</p>
                </div>
                <div class="prime_minister_picture">
                    <img v-if="primePresedent.prime_minister_image"
                        :src="`/backend/images/primepresedent/${primePresedent.prime_minister_image}`" width="150"
                        height="200px" alt="Prime Minister">
                </div>
                <div class="education_minister_name_details w-10">
                    <p>{{ primePresedent.prime_minister_name }}</p>
                </div>
            </div>
            <div class="prime_minister d-flex align-items-center w-50 mb-3 ps-3">
                <div class="prime_minister_name mb-2 w-100 prime_color">
                    <p>{{ primePresedent.president_designation }}</p>
                </div>
                <div class="prime_minister_picture">
                    <img v-if="primePresedent.president_image"
                        :src="`/backend/images/primepresedent/${primePresedent.president_image}`" width="134"
                        height="200px" alt="President">
                </div>
                <div class="education_minister_name_details">
                    <p>{{ primePresedent.president_name }}</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between w-100 mb-3">
            <div class="education_minister d-flex align-items-center w-50 pe-3">
                <div class="education_minister_name mb-2 w-100 prime_color">
                    <p>{{ educationBoard.edesignation }}</p>
                </div>
                <div class="education_minister_picture">
                    <img v-if="educationBoard.e_image" :src="`/backend/images/educationboard/${educationBoard.e_image}`"
                        width="140" height="200px" alt="Education Minister">
                </div>
                <div class="education_minister_name_details">
                    <p>{{ educationBoard.eminister_name }}</p>
                </div>
            </div>
            <div class="education_minister d-flex align-items-center w-50 mb-3">
                <div class="education_minister_name mb-2 w-100 prime_color">
                    <p>{{ educationBoard.bdesignation }}</p>
                </div>
                <div class="education_minister_picture">
                    <img v-if="educationBoard.b_image" :src="`/backend/images/educationboard/${educationBoard.b_image}`"
                        width="134" height="200px" alt="Board Chairman">
                </div>
                <div class="education_minister_name_details">
                    <p>{{ educationBoard.bminister_name }}</p>
                </div>
            </div>
        </div>
        <div class="institute_history_heading fw-bold fs-5">
            <a href="#" class="text-dark">প্রতিষ্ঠানের ইতিহাস</a>
        </div>
        <div class="institute_history_details">
            <p class="mb-3">
                {{ history }}
                <button v-if="fullHistory.length > 10" class="btn btn-link p-0 ms-2" @click="toggleModal">
                    Show More
                </button>
            </p>
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
export default {
    name: "Instituteview",
    props: {
        history: {
            type: String,
            required: true
        },
        fullHistory: {
            type: String,
            required: true
        },
        educationBoard: {
            type: Object,
            required: true
        },
        primePresedent: {
            type: Object,
            required: true
        }
    },
    setup() {
        const toggleModal = () => {
            const modal = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
            modal.show();
        }
        return {
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

.prime_color {
    background-color: rgb(6, 168, 225);
    border-radius: 5px;
}

.showmore {
    color: rgb(6, 168, 225);
}
</style>