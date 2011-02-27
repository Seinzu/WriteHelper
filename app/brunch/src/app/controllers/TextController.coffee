class TextController extends Backbone.Controller
  routes :
    "text": "index"

  constructor: ->
    super

  index: ->
    text = new TextView()
    text.render()
