class AuthorView extends Backbone.View
  id: 'author-view'

  render: ->
    $(@.el) .html(app.templates.header())
	          .appendTo($("body"))
    $("<p>").html("Author here")
	          .appendTo($("body"))

