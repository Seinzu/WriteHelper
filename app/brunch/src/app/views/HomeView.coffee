class HomeView extends Backbone.View
  id: 'home-view'

  render: ->
    $(@.el) .html(app.templates.home())
            .appendTo($('body'))
