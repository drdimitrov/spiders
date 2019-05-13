<template>
    <div>
        <label for="sel1">Choose author and year of publishing:</label><br>
        <div class="form-group" style="display: inline-block; margin-bottom: 0;">
            <input type="text" id="year_published" v-model="year_published" class="form-control" placeholder="Year">
        </div>
        <div class="form-group" style="display: inline-block">
            <input type="text" id="author_name" class="form-control" placeholder="Choose Author">
        </div>
        &nbsp;&nbsp;
        <div class="form-group">
            <label for="rejected">Select paper:</label>
            <select class="form-control" id="rejected" name="rejected">
                <option v-for="paper in papers" :value="paper.id">{{paper.name}}</option>
                <option v-if="this.pred_paper" :value="this.pred_paper">{{ this.pred_paper }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    import autocomplete from 'autocomplete.js';
    import algolia from 'algoliasearch';

    export default {
        props: ['pred_paper'],

        data(){
            return {
                author : null,
                year_published : null,
                papers : []
            }
        },

        methods: {
            //
        },

        mounted() {

            const index = algolia('G437GIPECU', 'ed5ac16faecbf760f179127985d565f1')
                .initIndex('authors');

            let selectAuthor = autocomplete('#author_name', {
                hint : true
            }, {
                source : autocomplete.sources.hits(index, {
                    hitsPerPage : 50
                }),
                displayKey : 'last_name',
                templates : {
                    suggestion(suggestion){
                        return `<span>${suggestion._highlightResult.last_name.value} ${suggestion.first_name}</span>`;
                    }
                },
                empty : `<div class="aa-empty">No authors found</div>`
            }).on('autocomplete:selected', function(event, suggestion, dataset){
                this.author == suggestion.id;
                this.pred_paper = null;

                $.post('/algolia/search-papers', {
                    author : suggestion.id,
                    year : this.year_published,
                    _token: $("meta[name='csrf-token']").attr("content")
                }, (data) => {
                    data.papers.forEach((e) => {
                        this.papers.push(e);
                    });
                });
            }.bind(this));

        }
    }
</script>
