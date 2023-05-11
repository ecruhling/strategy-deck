=== Strategy Deck ===
Contributors: ecruhling
Tags:
Requires at least: 4.9
Tested up to: 5.3
Stable tag: 1.0.0
Requires PHP: 7.0

A WordPress plugin for creating a custom post type 'deck' that is used in the client discovery process.

== Description ==

To be used during the client discovery process, the user can create a custom post, called a 'deck.' Each deck contains
multiple 'cards,' each card contains a single adjective. The user can further select or deselect the cards that correspond
to the upcoming project.

Creation and ordering of the cards is done entirely in the WordPress backend using the normal block editor methods. The cards
can be selected / deselected on the front end. The text on each card may also be edited on the front end.

++ IMPORTANT NOTE ++

There is no security on the front end for any 'deck' posts! That means anyone in the world can edit your pages by changing
the selected state and changing the text contained within each card! You may consider password-protecting each post
with WordPress' built-in password protection. All posts should also be protected from search engine crawlers by setting
noindex on the page.

    A commented-out method 'check_deck_permissions' is available in the file rest/Deck.php, which applies the standard
WordPress security to editing of the page, i.e. only logged in users are allowed to edit.

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0.0 =
* A change since the previous version.
* Another change.
