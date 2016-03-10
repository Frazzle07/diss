Vue.component('files',{
	template: '#files-template',

	props: ['list'],

	created(){
		this.list = JSON.parse(this.list);
	}
})

Vue.filter('truncate', function(value, length) {
  if(value.length < length) {
    return value;
  }

  length = length - 3;

  return value.substring(0, length) + '...';
});

new Vue({
	el: '#app',

	data: {
		search: ''
	},

	/*ready: function(){
		this.fetchFiles();
	},

	methods: {
		fetchFiles: function() {
			this.$http.get('/api/messages', function(files){
				this.$set('files', files);
			});
		}
	}*/
})