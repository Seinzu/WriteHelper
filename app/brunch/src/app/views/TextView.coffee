class TextView extends Backbone.View
  id: 'text-view'

  render: ->
    $(@.el) .html(app.templates.header())
	          .appendTo($("body"))
    $("<p>").html("Text here")
	          .appendTo($("body"))

