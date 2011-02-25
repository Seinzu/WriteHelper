class AuthorController extends Backbone.Controller
  routes :
    "author": "index"

  constructor: ->
    super

  index: ->
    author = new AuthorView()
    author.render()
