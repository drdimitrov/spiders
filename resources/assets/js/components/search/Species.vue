<template> 
    <div>
    	<input class="form-control" v-model="search" type="text" style="display: inline-block;" placeholder="Choose speies">
		<input type="hidden" name="species_id" v-model="species_id">
	    <ul id="selectResults">
	    	<li v-for="spc in species"><a href="#" @click.prevent="selectSpecies(spc)">{{ spc.name }} > {{ spc.genus.name }}</a></li>
	    </ul>
    </div>
</template>

<script>
	import debounce from 'debounce';

	export default{
		data(){
			return {
				search: '',
				species_id: null,
				species: []
			}
		},

		watch: {
			search(){
				this.findSpecies();
			}
		},

		created(){
			this.findSpecies = debounce(this.findSpecies, 500);
		},

		methods: {
			findSpecies(){
				axios.post('/admin/records/search-species', {
					species: this.search
				}).then((response) => {
					this.species = response.data;
				});
			},

			selectSpecies(species){
				this.search = `${species.genus.name} ${species.name}`;
				this.species_id = species.id;
				this.species = [];				
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