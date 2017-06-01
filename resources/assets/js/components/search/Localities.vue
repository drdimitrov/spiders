<template> 
    <div>
    	<input class="form-control" v-model="search" type="text" >
		<input type="hidden" name="locality_id" v-model="locality_id">
	    <ul id="selectResults">
	    	<li v-for="loc in localities"><a href="#" @click.prevent="selectLocality(loc)">{{ loc.name }}</a></li>
	    </ul>
    </div>
</template>

<script>
	import debounce from 'debounce';

	export default{
		data(){
			return {
				search: '',
				locality_id: null,
				localities: []
			}
		},

		watch: {
			search(){
				this.findLocality();
			}
		},

		created(){
			this.findLocality = debounce(this.findLocality, 400);
		},

		methods: {
			findLocality(){
				axios.post('/admin/records/search-localities', {
					locality: this.search
				}).then((response) => {					
					this.localities = response.data;
				});
			},

			selectLocality(locality){
				this.search = `${locality.name}.`;
				this.locality_id = locality.id;
				this.localities = [];				
			}
			
		}

	}
</script>

<style lang="scss">
	#selectResults{
		display: inline-block;
		margin: 0;
		padding: 0;
		list-style-type: none;
		background: #f2f2f2;
    	width: 100%;

		li{
			font-weight: bold;
			margin: 10px;
		}
	}
</style>