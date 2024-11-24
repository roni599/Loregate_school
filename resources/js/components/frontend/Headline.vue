<template>
    <div class="headline mb-4">
        <marquee>
            <template v-for="(item, index) in headings" :key="index">
                ** {{ item }} **
            </template>
        </marquee>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    name: "Headline",
    setup() {
        const headings = ref([]);
        const academy_id = ref(3);

        const fetchData = async () => {
            try {
                const response = await axios.get(`/api/academy/heading/find/${academy_id.value}`);
                if (response.data) {
                    headings.value = response.data.heading.headings;
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        onMounted(() => {
            fetchData();
        });

        return {
            academy_id,
            headings,
        };
    },
};
</script>

<style scoped>
@media (max-width: 768px) {
    marquee {
        font-size: 1.2rem;
    }
}
</style>