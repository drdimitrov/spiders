<template>
    <div id="map" style="width: 500px; height: 400px;"></div>
</template>

<script>
   
    export default {
        data(){
            return {
                //
            }
        },
        props : ['localities'],        
        events : {
            MapsApiLoaded(){
                this.createMap()
            }
        },
        methods: {
            createMap(){
                this.map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: 41.865545, 
                        lng: 27.966174
                    },
                    scrollwheel: false,
                    zoom: 8
                })
            }
        }
    }

</script>
