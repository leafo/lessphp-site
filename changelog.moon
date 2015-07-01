{
  title: "Changelog"
  link_to_home: true
}

discount = require "discount"
feed = require "feed"

import trim_leading_white from require "sitegen.common"

html ->
  div {
    class: "changelog"

    h2 "Changelog"
    for entry in *feed
      div {
        class: "release"
        id: "v" .. entry._release.version
        raw discount trim_leading_white entry.description
      }
  }
