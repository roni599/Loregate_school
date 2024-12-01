<template>
    <div class="footer-container container w-100">
        <div class="footer-item w-25">
            <div class="address">
                <p>4A, 374 Haose</p>
                <p>Free Srate School</p>
                <p>Pokorpar, Dominogoli</p>
                <p>Hatirpol, Dhanmondi, Dhaka</p>
            </div>
        </div>
        <div class="footer-item w-25">
            <div class="logo">
                <div class="loragate_image mb-3">
                    <img src="../../../../public/frontend/images/loregate.png" width="50" height="50"
                        class="rounded-circle" alt="Logo">
                </div>
                <div class="social_icon d-flex justify-content-center gap-3">
                    <div class="facebook">
                        <img src="../../../../public/frontend/images/facebook.png" width="30px" alt="Facebook Icon">
                    </div>
                    <div class="youtube">
                        <img src="../../../../public/frontend/images/youtube.png" width="30px" alt="YouTube Icon">
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-item w-50">
            <div class="map rounded-3">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3648.8576475601875!2d90.3766180154334!3d23.744499194424452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf5657e690d1%3A0x8c4e1ef807124acb!2sHatirpool%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1691610379267!5m2!1sen!2sbd"
                    width="250px" height="130px" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    name: "Footer-vue",
    setup() {
        return {

        }
    }
}
</script>
<style scoped>
.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    text-align: center;
}

.map iframe {
    border-radius: 5px;
}

.footer-item {
    flex: 1 1 100%;
    max-width: 30%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.address p {
    line-height: 0;
    text-align: justify;
}

@media (max-width: 768px) {
    .footer-item {
        margin-top: 10px;
        flex: 0 1 100%;
        max-width: 100%;
        height: 120px;
    }

    .address p {
        text-align: center;
    }
}
</style>
