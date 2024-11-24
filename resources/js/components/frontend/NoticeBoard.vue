<template>
    <div class="container notice_board_page py-5">
        <div class="academydiv m-auto fw-bold mb-5">Notice Board</div>
        <div class="table_of_notice">
            <div class="tableforDetails col-12 col-lg-8 m-auto">
                <table class="table table-responsive table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="bg-info">Publish Date</th>
                            <th class="bg-info text-center">Subject</th>
                            <th class="bg-info text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="boardnotice in boardNotices" :key="boardnotice.id">
                            <td> {{ boardnotice.date }}</td>
                            <td> {{ boardnotice.subject }}</td>
                            <td class="text-center"><button class="btn btn-sm btn-info" @click="view(boardnotice.id)"><i
                                        class="fa-solid fa-eye text-white"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



        <!-- Modal 1 -->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
            tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header hide-on-print">
                        <button type="button" class="btn-close d-flex justify-content-end" data-bs-dismiss="modal"
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

    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    name: "NoticeBoard",
    setup() {
        const boardNotices = ref([]);
        const boardNoticeSingleData = ref({});

        const academy_id = ref(5);
        const academy_details = ref({})

        const fetchData = async () => {
            try {
                const response = await axios.get(`/api/academy/header/find/${academy_id.value}`);
                if (response.data) {
                    academy_details.value = response.data.data;
                }
            } catch (error) {
                console.log('something wrong')
            }
        }

        const view = async (id) => {
            const modal = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
            try {
                const response = await axios.get(`/api/academy/board-notice/find/${id}`)
                if (response.data.data) {
                    boardNoticeSingleData.value = response.data.data;
                }
            } catch (error) {

            }
            modal.show();
        }

        const boardNoticeData = async () => {
            try {
                const response = await axios.get('/api/academy/board-notice')
                if (response.data.data) {
                    boardNotices.value = response.data.data;
                }
            } catch (error) {

            }
        }
        const formattedDate = (date) => {
            const d = new Date(date);
            const day = d.getDate().toString().padStart(2, '0');
            const month = (d.getMonth() + 1).toString().padStart(2, '0');
            const year = d.getFullYear();
            return `${day}/${month}/${year}`;
        };

        const printInvoice = () => {
            window.print();
        }

        onMounted(() => {
            boardNoticeData();
            fetchData();
        })
        return {
            view,
            boardNotices,
            boardNoticeData,
            boardNoticeSingleData,
            formattedDate,
            academy_details,
            fetchData,
            printInvoice

        }
    }
}
</script>

<style scoped>
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
    /* margin-top: 130px; */
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