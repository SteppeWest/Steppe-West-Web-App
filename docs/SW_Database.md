# SW Database

* Database name `u746306670_sw_basic`.

## Table `sw_lang_basic`

Stores all the data that is, or may be, used in language lists.

### Table Structure

Field Name | Type       | Description
---------- | ---------- | -----------
pk         | `smallint` | Primary key `autoincrement`.
code       | `tinytext` | The language code, mostly 2 lowercase letters.
active     | `tinyint`  | `true` if the language is in use.
position   | `smallint` | The position in the list.
name       | `tinytext` | The name of the language in English.
native     | `tinytext` | The name of the language in itself.
flag       | `tinytext` | The country code if the language corresponds to a flag emoji. An identifier for an in-house SVG otherwise.
label      | `tinytext` | The label for the language in menus & lists.

The Steppe West web app is always using selection, `active` equals `true`, sorted by `position`.

## Table `sw_lang_common`

Stores all the data that is common to all pages. All records are different language versions of the same content.

### Table Structure

Field Name | Type       | Description
---------- | ---------- | -----------
pk         | `smallint` | Primary key `autoincrement`.
code       | `tinytext` | The language code.
locale     | `tinytext` | The locale code.
lang       | `tinytext` | The language code, localised if necessary.
origin     | `tinytext` | A sentence pointing to the origin on Substack.
footer_yaml | `text`    | YAML for the footer contents.

The Steppe West web app always uses a selection of one record, being the record for which `code` matches the language code derived from the URL.

### Example `footer_yaml`

```yaml
- content:
  - type: sentence
    text: "Steppe West acknowledges the {GubbiGubbi} (also known as the {KabiKabi}) peoples, on whose land we are based."
  - type: sentence
    text: "Steppe West is, & always will be, a not for profit enterprise."
  - type: sentence
    text: "Steppe West stands with {UA} Ukraine & {PS} Palestine."
  - type: copyright
    text: "Copyright © Steppe West 2024."
```

## Table `sw_lang_pages`

Stores all the data that is page specific. All records for any value of `page` are different language versions of the same content.

### Table Structure

Field Name | Type       | Description
---------- | ---------- | -----------
pk         | `smallint` | Primary key `autoincrement`.
code       | `tinytext` | The language code.
page       | `tinytext` | The subdomain where there is one. `home` for no subdomain.
title      | `text`     | The page title.
subtitle   | `text`     | The page subtitle (optional).
description| `text`     | The page description.
keywords   | `text`     | The page keywords.
lead       | `text`     | The page lead (optional).
body_yaml  | `text`     | YAML for the page body.

The Steppe West web app always uses a selection of one record, being the record for which `code` matches the language code derived from the URL **AND** `subdomain` matches the subdomain in use (or `home` if no subdomain).

### Example `footer_yaml`

```yaml
- content:
  - type: h4
    text: "What's Steppe West All About?"
  - type: paragraph
    text: "Think of us as a cultural bridge, spanning from the vast steppes of Central Asia to the shores of Australia and beyond. We delve into the vibrant world of Central Asian music, arts, cuisine, history, and more, presenting these treasures in a way that's engaging and accessible for everyone."
- content:
  - type: h4
    text: "Our Mission"
  - type: paragraph
    text: "At Steppe West, we're not just about showcasing content; we're about fostering genuine connections and understanding between cultures. We believe that the rich tapestry of Turkic and Mongol cultures deserves a spot on the global stage, and we're here to make that happen."
- content:
  - type: h4
    text: "How We Do It"
  - type: paragraph
    text: "Working closely with creators from Central Asia, we bring their stories to life across a variety of platforms. Whether it's a soulful melody from the steppes, a mouth-watering recipe, or a captivating tale of historical significance, we make sure each piece of content is presented authentically and respectfully. And we always give credit where it's due, linking back to the original creators."
- content:
  - type: h4
    text: "Language Accessibility"
  - type: paragraph
    text: "We understand that language can be a barrier, which is why we put a strong emphasis on making Central Asian content accessible to English-speaking audiences. Our translations and presentations are crafted to retain the original essence and beauty of these stories, ensuring nothing gets lost in translation."
- content:
  - type: h4
    text: "Join Us on This Journey"
  - type: paragraph
    text: "We're keen on collaboration and believe that every voice adds a unique thread to our cultural tapestry. If you're passionate about discovering and sharing the diverse wonders of Central Asia—be it music, art, food, sports, or stories—Steppe West is your platform. Your interest and engagement are what make Steppe West truly special."
- content:
  - type: h4
    text: "Get Involved"
  - type: paragraph
    text: "Got a question, suggestion, or something to share? Don't be shy! Drop us a line, and let's start a conversation. Even if Steppe West isn't quite your thing, feel free to pass the word along to others who might be interested."
- content:
  - type: h4
    text: "Meet the Team"
  - type: paragraph
    text: "We're a small but passionate team, including a talented young bloke from Uzbekistan, bringing fresh perspectives and a deep understanding of Central Asian culture to our work."
- content:
  - type: paragraph
    text: "So, come along for the ride as we explore the wonders of Central Asia together. Steppe West is all about sharing, learning, and celebrating the beauty of our diverse world. Let's make some magic happen!"
  - type: paragraph
    text: "Cheers, Pedro"
```
