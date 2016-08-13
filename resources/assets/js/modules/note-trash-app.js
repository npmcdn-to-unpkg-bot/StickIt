
new Vue({
    el: '#note-trash-app',

    data: {
        notes: [],
        loading: false
    },

    ready: function () {
        this.loadNotes();
    },

    methods: {
        loadNotes: function () {
            this.loading = true;

            this.$http.get('/api/notes/trash').then(function (response) {
                this.notes = response.json();
                $('.loading').removeClass('loading');
                this.loading = false;
            }, function () {
                this.loading = false;
                alert('Something Went Wrong');
            });
        },
        permDelete: function (note) {
            var self = this;

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function () {
                self.$http.get('/api/notes/perm/' + note.id).then(function (response) {
                    self.notes.$remove(note)
                }, function () {
                    alert('Something Went Wrong');
                });
            });
        },
        permDeleteAll: function () {
            var self = this;

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function () {
                self.$http.get('/api/notes/perm/all').then(function (response) {
                    self.notes = [];
                }, function () {
                    alert('Something Went Wrong');
                });
            });
        },
        restoreNote: function (note) {
            this.$http.get('/api/notes/restore/' + note.id).then(function (response) {
                this.notes.$remove(note)
            }, function () {
                alert('Something Went Wrong');
            });
        }
    }
});