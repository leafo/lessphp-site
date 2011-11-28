    link_to_home: true
--

## Changelog

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

