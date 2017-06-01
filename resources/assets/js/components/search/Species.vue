<template> 
    <div>
    	<input class="form-control" v-model="search" type="text" >
		<input type="hidden" name="species_id" v-model="species_id">
	    <ul>
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
			this.findSpecies = debounce(this.findSpecies, 400);
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