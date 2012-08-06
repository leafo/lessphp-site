    link_to_home: true
--

## Changelog

<a name="v0.3.6"></a>
**version 0.3.6 - August 6th 2012**

* Added support for `@media` bubbling, you can now nest media blocks anywhere, and inside of each other
* Added a option to enable the preservation of `/**/` comments. [setPreserveComments](http://leafo.net/lessphp/docs/#preserving_comments)
* Changed default output formatter to match lessjs
* Change internal structure of numbers and strings, **you will have to update your registered functions**
* Disabled color compression, fixed a bug in sorting of properties that prevent your from overwriting same named properties
* Fixed alpha(opactiy=) bug. Better support for IE style colors in filter() values
* Better fallback for expressions that can't be evaluated
* Misc bug fixes, enhanced test coverage significantly (now using [travisci](http://travis-ci.org/#!/leafo/lessphp))

<a name="v0.3.5"></a>
**version 0.3.5 - June 10th 2012**

* Added [output formatters, and compressed format](http://leafo.net/lessphp/docs/#output_formatting)
* Support for [`!important` suffix on mixin](http://leafo.net/lessphp/docs/#important) (nyordanov)
* Added [Composer package](http://packagist.org/packages/leafo/lessphp)
* Property assignments moved to top of block (to match lessjs)
* Handful of misc bug fixes, and huge code refactor

<a name="v0.3.4-2"></a>
**version 0.3.4-2 - April 17th 2012 (Bugfix)**

* Fixed error about missing `is_vararg` for some blocks

<a name="v0.3.4"></a>
**version 0.3.4 - April 12th 2012**

* Added [Selector Expressions](http://leafo.net/lessphp/docs/#selector_expressions)
* Allow for mixins to recurse
* Added varags syntax
* Fixed bug with `~` and string interpolation
* `ceil` function (krues8dr), `argb` function (Barryvdh)
* Misc bug fixes

<a name="v0.3.3"></a>
**version 0.3.3 - February 26th 2012**

* Importing done before evaluating to allow referencing mixins imported
  from other files before they are defined.
* Fixed spin function to wrap hue around 0-360
* Resulting unit of math expressions matches less.js in all cases
* Division operator handled more like less.js (using property name,
  see division section of [Expressions](http://leafo.net/lessphp/docs/index.html#expressions))
* Mixins look up variables in their lexical scope when being mixed (instead of the target scope)
* Expressions in variables evaluated in referenced scope instead of declared scope
* Infinite loop detection for new evaluation model
* Improved error messages for compile time errors
* Expressions can be placed in @media queries
* Default arguments appear in @arguments
* Tweaked output of color functions to match less.js
* Misc Bug fixes


<a name="v0.3.2"></a>
**version 0.3.2 - February 15th 2012**

* [Pattern matching](http://leafo.net/lessphp/docs/index.html#pattern_matching)
* [Guards](http://leafo.net/lessphp/docs/index.html#guards)
* [Variable variables](http://leafo.net/lessphp/docs/index.html#variables)
* Testing script works on windows (thanks GerHobbelt)
* Instance of `lessc` passed to extension functions as second arg
* Fix broken nested import bug
* Misc bug fixes

<a name="v0.3.1"></a>
**version 0.3.1 - January 8th 2012**

* New [extension function
  interface](http://leafo.net/lessphp/docs/index.html#custom_functions) without
  subclassing
* Support for [`@arguments` special
  variable](http://leafo.net/lessphp/docs/index.html#arguments_variable)
* Added built in functions `alpha`, `fade`, `mix`, `percentage`
* Color keywords are translated to their rgb version when used in expressions
  and functions
* Misc bug fixes

<a name="v0.3.0"></a>
**version 0.3.0 - November 27th 2011**

* compatibility update for lessjs
* changed argument delim to `,`
* don't need a `>` to delimit mixin path
* added `%` string escape function
* change string variable interpolation syntax to `@{var}`
* psuedo classes are not joined automatically when nested
* `&` can be used anywhere in selector to represent parent
* `~` operator, and `e` function for unquoting a string

<a name="v0.2.0"></a>
**version 0.2.0 - March 27 2010**

-   reimplemented core parsing techniques, 50% speed up
-   all css selectors should be functional
-   support for @charset @font-face
-   `&` operator for nesting chained blocks
-   `!` operator for inserting important property
-   exposed function api: <http://github.com/leafo/lessphp/commit/2fb4296a6a7287ea53e99b73858bfd5a44834cad>
-   much better number, color, and string parsing support

<a name="v0.1.6"></a>
**version 0.1.6 - August 21 2009**

-   rewrote command line tool, plessc, with more logical argument
    parsing and proper exit codes
-   separate blocks of the same name will now merge instead of
    overwriting each over
-   fixed a bug with any type of mixin not searching outside the scope
-   updated this webpage

<a name="v0.1.5"></a>
**version 0.1.5 - August 6 2009**

-   wrote documentation, see <http://leafo.net/lessphp/docs/>
-   added support for variables inside of strings
-   mixins append their data into the block instead of overwriting
-   fixed a bug where rgb was being ignored since 0.1.4


<a name="v0.1.4"></a>
**version 0.1.4 - August 4 2009**

-   blocks that start with @ are treated as abstract blocks and are not
    printed out
-   all blocks/mixins can now take argument lists (with default args)
    and be treated as functions
-   fixed bug with nested blocks inside of a mixin printing the name of
    the mixin
-   added the ability to specify import directory for @import
-   the correct import directory is figured out automatically when you
    compile from file path
-   fixed bug with @import and comments in imported file

<a name="v0.1.3"></a>
**version 0.1.3 - July 28 2009**

-   setting variables to themselves in equations works how you expect
-   parentheses are supported in arithmetic
-   all variables and arithmetic do lazy evaluation, variables are set
    to the equation and not the value
-   code no longer throws php notices

<a name="v0.1.2-1"></a>
**version 0.1.2-1 - July 23 2009 bugfix**

-   issue with comments and whitespace on head of document fixed

<a name="v0.1.2"></a>
**version 0.1.2 - July 23 2009**

-   Performance enhancements (50% faster compile for average case)
-   Accepts more native css properties and values (still some trouble
    with more advanced css3 stuff)
-   Better string support in general
-   Comments will no longer be interpreted from within strings

<a name="v0.1.1"></a>
**version 0.1.1 - July 22 2009**

-   New @import parsing, supports media
-   Repeated properties are all written instead of overwriting each
    other
-   Support for additional css properties and values that were left out
-   New comment parsing prevents comments inside of strings from being
    removed
-   Added a static compile on demand function to lessc
-   Updated command line utility significantly
-   Fixed color rendering bug for small rgb values

<a name="v0.1.0"></a>
**version 0.1.0 - July 21 2009 Initial release**

