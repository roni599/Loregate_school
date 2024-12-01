<template>
    <div class="academy_propitor_teacher_gallary container d-flex flex-column flex-lg-row align-items-center gap-4 mb-5">
        <div class="all col-12 col-lg-4 px-5">
            <p class="text-center mb-3 fw-bold fs-6"> Academy Proprietor</p>
            <div class="academy_propitor gap-3 d-flex justify-content-center mb-3">
                <div v-for="(item) in displayedData" :key="item.id" class="img_academy_propitor">
                    <img v-if="item.image" :src="`/backend/images/managingcummunity/${item.image}`" width="100px"
                        :alt="item.name" />
                </div>
            </div>
            <router-link to="/home-managingcommunity" class="text-decoration-none">
                <p class="text-center fw-bold fs-6">View All</p>
            </router-link>
            <p class="text-center fw-bold fs-6">Teacher Gallery</p>
            <div class="academy_propitor gap-3 d-flex justify-content-center mb-3">
                <div v-for="(item) in displayedData2" :key="item.id" class="img_academy_propitor">
                    <img v-if="item.image" :src="`/backend/images/teachergallery/${item.image}`" width="100px"
                        :alt="item.name" />
                </div>
            </div>
            <router-link to="/home-teachergallery" class="text-decoration-none">
                <p class="text-center fw-bold fs-6">View All</p>
            </router-link>
        </div>
        <div class="tableforDetails col-12 col-lg-8 px-lg-0 px-md-0 px-sm-5">
            <p class="text-center fw-bold fs-5 text-primary">Notice Board</p>
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-responsive table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="bg-info text-center text-white">Publish Date</th>
                            <th class="bg-info text-center text-white">Subject</th>
                            <th class="bg-info text-center text-white">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in boardNotices" :key="item.id">
                            <td>{{ item.date }}</td>
                            <td>{{ item.subject }}</td>
                            <td class="text-center"><button class="btn btn-sm btn-info" @click="showNotice(item.id)"><i
                                        class="fa-solid fa-eye text-white"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="modal fade" id="exampleModalToggleuu" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header hide-on-print">
                    <button type="button" class="btn-close d-flex justify-content-end " data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container notice_view">
                        <h4 class="text-center mb-4">Notice view</h4>
                        <div class="collage_photo mb-4">
                            <img :src="`/backend/images/academy/${academy_details.academy_logo}`" width="70px"
                                height="70px" alt="">
                        </div>
                        <div class="notice_address text-center">
                            <h2 class="">{{ academy_details.academy_name }} </h2>
                            <p class="text-center h6 mb-5">
                                <span>{{ academy_details.academy_address }}</span><br>
                                <span> {{ academy_details.academy_mobile_number }}</span>
                            </p>
                        </div>
                        <div class="date_principle h6 mb-5">
                            <span> Date: {{ formattedDate(boardNoticeSingleData.date) }} <br>
                                {{ boardNoticeSingleData.reference }}</span>
                        </div>
                        <div class="subject mb-5">
                            <p class="h6"> Subject: {{ boardNoticeSingleData.subject }}</p>
                        </div>
                        <div class="details_notice mb-5">
                            <p>{{ boardNoticeSingleData.description }}</p>
                        </div>
                        <div class="image">
                            <img v-if="boardNoticeSingleData.signature"
                                :src="`/backend/images/boardNotice/${boardNoticeSingleData.signature}`" width="50px"
                                height="50px" alt="">
                        </div>
                        <div class="hr_rule" style="">

                        </div>
                        <div class="signature text-end">
                            <p>স্বাক্ষর</p>
                        </div>
                        <div class="print-button d-flex justify-content-center pt-4 hide-on-print">
                            <button @click="printInvoice" class="btn btn-primary print-button">Print
                                Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';

export default {
    name: "PropiterTeacher",
    props: {
        displayedData: {
            type: Object,
            Required: true,
        },
        displayedData2: {
            type: Object,
            required: true
        },
        propiterTeacher:
        {
            type: Array,
            required: true
        },
        teacherGallery:
        {
            type: Array,
            required: true
        },
        boardNotices: {
            type: Object,
            require: true
        },
        academy_details: {
            type: Object,
            require: true
        }
    },
    setup() {
        const boardNoticeSingleData = ref({});
        const showNotice = async (id) => {
            const modal = new bootstrap.Modal(document.getElementById('exampleModalToggleuu'));
            try {
                const response = await axios.get(`/api/academy/board-notice/find/${id}`)
                if (response.data.data) {
                    boardNoticeSingleData.value = response.data.data;
                }
            } catch (error) {

            }
            modal.show();
        }

        const formattedDate = (date) => {
            const d = new Date(date);
            const day = d.getDate().toString().padStart(2, '0');
            const month = (d.getMonth() + 1).toString().padStart(2, '0');
            const year = d.getFullYear();
            return `${day}/${month}/${year}`;
        };
        return {
            showNotice,
            boardNoticeSingleData,
            formattedDate
        }
    }
}
</script>

<style scoped>
.boardnews_details {
    width: 70%;
    background-color: rgb(203, 230, 253);
    margin: auto;
    padding: 40px;
    text-align: justify;
}

@media (max-width: 768px) {
    .boardnews_details {
        width: 90%;
        padding: 30px;
    }
}

@media (max-width: 576px) {
    .boardnews_details {
        width: 95%;
        padding: 20px;
    }
}

.academydiv {
    width: 290px;
    background-color: red;
    text-align: center;
    padding: 10px 0px;
    color: white;
}

.collage_photo {
    display: flex;
    justify-content: center;
    align-items: center;
}

.details_notice {
    text-align: justify;
}

.image {
    width: 10%;
    margin-left: auto;
    margin-top: 130px;
}

.hr_rule {
    height: 2px;
    background-color: black;
    width: 10%;
    margin-left: auto;
    border-top: 1px solid black;
}

@media print {
    .hide-on-print {
        display: none !important;
    }
}
</style>