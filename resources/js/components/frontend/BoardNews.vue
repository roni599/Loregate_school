<template>
    <div class="container">
        <div class="boardnewsHeader py-5">
            <h2 class="text-center">Board News</h2>
        </div>
        <div class="boardnews_details mb-5">
            <p class="text-center">{{ BoardNewsdata.heading }}</p>
            {{ BoardNewsdata.description }}
            <p class="text-center mt-2">
                <span>তথ্য সূত্র: {{ BoardNewsdata.data_sources }}</span><br>
                <span>তারিখ: {{ formattedDate(BoardNewsdata.date) }}</span>
            </p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    name: "BoardNews",
    props: ['id'],
    setup(props) {
        const BoardNewsdata=ref({});
        const fetchBoardNews=async()=>{
            try {
                const response=await axios.get(`/api/academy/boardnews/find/${props.id}`);
                if(response.data.data){
                    BoardNewsdata.value=response.data.data;
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
        onMounted(()=>{
            fetchBoardNews();
        })
        return {
            id: props.id,
            BoardNewsdata,
            fetchBoardNews,
            formattedDate
        };
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
</style>