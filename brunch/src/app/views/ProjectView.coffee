class ProjectView extends Backbone.View
  id: 'project-view'

  render: ->
    $(@.el) .html(app.templates.header())
            .appendTo($("body"))
  
