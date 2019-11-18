<template>
    <div>    
        <div class="checkbox">
            <label><input class="record_rejected" type="checkbox" :v-model="is_rejected" @change="isChecked">Is rejected?</label>
        </div>

        <div :class="!this.is_rejected ? 'rejected_hidden' : ''">
            <label for="sel1">Choose author that rejected the record:</label><br>
            <div class="form-group" style="display: inline-block; margin-bottom: 0;">
                <input type="text" id="year_rejected" v-model="year_rejected" class="form-control" placeholder="Year">
            </div>
            <div class="form-group" style="display: inline-block">
                <input type="text" id="author_rejected_name" class="form-control" placeholder="Choose Author">
            </div>
            &nbsp;&nbsp;
            <div class="form-group">
                <label for="rejected">Select paper:</label>
                <select class="form-control" id="rejected" name="rejected">
                    <option v-for="paper in papers" :value="paper.id">{{paper.name}}</option>
                    <option v-if="this.rejected_in_paper" :value="this.rejected_in_paper">{{ this.rejected_in_paper }}</option>
                </select>
            </div>
        </div>    
    </div>
</template>

<script>
    import autocomplete from 'autocomplete.js';
    import algolia from 'algoliasearch';

    export default {
        props: ['rejected_in_paper'],

        data(){
            return {
                is_rejected : false,
                author : null,
                year_rejected : null,
                papers : []
            }
        },

        methods: {
            isChecked(event) {
                this.$emit("input.record_rejected", event.target.checked)
                this.is_rejected = event.target.checked
            }
        },

        mounted() {

            const index = algolia('G437GIPECU', 'ed5ac16faecbf760f179127985d565f1')
                .initIndex('authors');

            let selectAuthor = autocomplete('#author_rejected_name', {
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
                this.rejected_in_paper = null;

                $.post('/algolia/search-papers', {
                    author : suggestion.id,
                    year : this.year_rejected,
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

<style>
    .rejected_hidden{
        display: none;
    }
</style>
