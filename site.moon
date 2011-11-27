require "sitegen"
site = sitegen.create_site =>
  @title = "lessphp"
  feed "feed.moon", "feed.xml"

site\write!
