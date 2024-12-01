<template>
    <div class="container py-5">
        <div class="magzine_details_list_all mb-3 d-flex justify-content-center align-items-center">
            <img class="magazine-image" src="../../../../public/frontend/images/Magazine_image.png"
                alt="Magazine Image">
        </div>
        <div>
            <p class="text-center">{{ magazineSingledata.subject }}</p>
        </div>
        <div class="magzine_details_list_all mb-1 d-flex justify-content-center align-items-center">
            <img :src="`/backend/images/magazine/${magazineSingledata.image}`" :alt="magazineSingledata.name"
                class="img-fluid" width="308" height="120" />
        </div>
        <div>
            <p class="text-center mb-4 h4">
                {{ magazineSingledata.heading }}
            </p>
        </div>
        <div class="details_magazine m-auto">
            <p>
                {{ magazineSingledata.description }}
            </p>
        </div>
        <div class="date_and_press m-auto">
            <p>
                <span>{{ formatToBanglaDate(magazineSingledata.date) }}</span><br>
                <span>{{ magazineSingledata.writer }}</span><br>
                <span>{{ magazineSingledata.data_sources }}</span>
            </p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import moment from "moment";
export default {
    name: "MagazinelistView",
    props: ['id'],
    setup(props) {

        const magazineSingledata = ref({});
        const magazineSingleData = async () => {
            try {
                const response = await axios.get(`/api/academy/magazinefind/${props.id}`);
                if (response.data.data) {
                    magazineSingledata.value = response.data.data
                }
            } catch (error) {

            }
        }

        const formatToBanglaDate = (date) => {
            if (!date) return "";
            const formattedDate = moment(date).format("DD/MM/YYYY");
            return formattedDate
                .split("/")
                .map((num) => convertToBanglaNumber(num))
                .join("/");
        };
        const convertToBanglaNumber = (number) => {
            const banglaDigits = ["০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯"];
            return number.toString().split("").map((digit) =>
                banglaDigits[digit] || digit
            ).join("");
        };
        onMounted(() => {
            magazineSingleData()
        })
        return {
            id: props.id,
            magazineSingledata,
            magazineSingleData,
            convertToBanglaNumber,
            formatToBanglaDate
        }
    }
}
</script>

<style scoped>
.details_magazine {
    width: 50%;
}

.details_magazine p {
    text-align: justify;
}

.date_and_press {
    width: 50%;
}
</style>