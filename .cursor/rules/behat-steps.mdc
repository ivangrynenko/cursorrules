---
description:
globs: *.feature,FeatureContext.php,*Context.php
alwaysApply: false
---
# Behat Steps - Claude Memory

## Available steps

### Index of Generic steps

| Class | Description |
| --- | --- |
| [CookieTrait](mdc:#cookietrait) | Verify and inspect browser cookies. |
| [DateTrait](mdc:#datetrait) | Convert relative date expressions into timestamps or formatted dates. |
| [ElementTrait](mdc:#elementtrait) | Interact with HTML elements using CSS selectors and DOM attributes. |
| [FileDownloadTrait](mdc:#filedownloadtrait) | Test file download functionality with content verification. |
| [KeyboardTrait](mdc:#keyboardtrait) | Simulate keyboard interactions in Drupal browser testing. |
| [LinkTrait](mdc:#linktrait) | Verify link elements with attribute and content assertions. |
| [PathTrait](mdc:#pathtrait) | Navigate and verify paths with URL validation. |
| [ResponseTrait](mdc:#responsetrait) | Verify HTTP responses with status code and header checks. |
| [WaitTrait](mdc:#waittrait) | Wait for a period of time or for AJAX to finish. |

### Index of Drupal steps

| Class | Description |
| --- | --- |
| [Drupal\BigPipeTrait](mdc:#drupalbigpipetrait) | Bypass Drupal BigPipe when rendering pages. |
| [Drupal\BlockTrait](mdc:#drupalblocktrait) | Manage Drupal blocks. |
| [Drupal\ContentBlockTrait](mdc:#drupalcontentblocktrait) | Manage Drupal content blocks. |
| [Drupal\ContentTrait](mdc:#drupalcontenttrait) | Manage Drupal content with workflow and moderation support. |
| [Drupal\DraggableviewsTrait](mdc:#drupaldraggableviewstrait) | Order items in the Drupal Draggable Views. |
| [Drupal\EckTrait](mdc:#drupalecktrait) | Manage Drupal ECK entities with custom type and bundle creation. |
| [Drupal\EmailTrait](mdc:#drupalemailtrait) | Test Drupal email functionality with content verification. |
| [Drupal\FieldTrait](mdc:#drupalfieldtrait) | Manipulate Drupal form fields and verify widget functionality. |
| [Drupal\FileTrait](mdc:#drupalfiletrait) | Manage Drupal file entities with upload and storage operations. |
| [Drupal\MediaTrait](mdc:#drupalmediatrait) | Manage Drupal media entities with type-specific field handling. |
| [Drupal\MenuTrait](mdc:#drupalmenutrait) | Manage Drupal menu systems and menu link rendering. |
| [Drupal\MetatagTrait](mdc:#drupalmetatagtrait) | Assert `<meta>` tags in page markup. |
| [Drupal\OverrideTrait](mdc:#drupaloverridetrait) | Override Drupal Extension behaviors. |
| [Drupal\ParagraphsTrait](mdc:#drupalparagraphstrait) | Manage Drupal paragraphs entities with structured field data. |
| [Drupal\SearchApiTrait](mdc:#drupalsearchapitrait) | Assert Drupal Search API with index and query operations. |
| [Drupal\TaxonomyTrait](mdc:#drupaltaxonomytrait) | Manage Drupal taxonomy terms with vocabulary organization. |
| [Drupal\TestmodeTrait](mdc:#drupaltestmodetrait) | Configure Drupal Testmode module for controlled testing scenarios. |
| [Drupal\UserTrait](mdc:#drupalusertrait) | Manage Drupal users with role and permission assignments. |
| [Drupal\WatchdogTrait](mdc:#drupalwatchdogtrait) | Assert Drupal does not trigger PHP errors during scenarios using Watchdog. |


---

## CookieTrait

[Source](mdc:src/CookieTrait.php), [Example](mdc:tests/behat/features/cookie.feature)

>  Verify and inspect browser cookies.
>  - Assert cookie existence and values with exact or partial matching.
>  - Support both WebDriver and BrowserKit drivers for test compatibility.


<details>
  <summary><code>@Then a cookie with the name :name should exist</code></summary>

<br/>
Assert that a cookie exists
<br/><br/>

```gherkin
Then a cookie with the name "session_id" should exist

```

</details>

<details>
  <summary><code>@Then a cookie with the name :name and the value :value should exist</code></summary>

<br/>
Assert that a cookie exists with a specific value
<br/><br/>

```gherkin
Then a cookie with the name "language" and the value "en" should exist

```

</details>

<details>
  <summary><code>@Then a cookie with the name :name and a value containing :partial_value should exist</code></summary>

<br/>
Assert that a cookie exists with a value containing a partial value
<br/><br/>

```gherkin
Then a cookie with the name "preferences" and a value containing "darkmode" should exist

```

</details>

<details>
  <summary><code>@Then a cookie with a name containing :partial_name should exist</code></summary>

<br/>
Assert that a cookie with a partial name exists
<br/><br/>

```gherkin
Then a cookie with a name containing "session" should exist

```

</details>

<details>
  <summary><code>@Then a cookie with a name containing :partial_name and the value :value should exist</code></summary>

<br/>
Assert that a cookie with a partial name and value exists
<br/><br/>

```gherkin
Then a cookie with a name containing "user" and the value "admin" should exist

```

</details>

<details>
  <summary><code>@Then a cookie with a name containing :partial_name and a value containing :partial_value should exist</code></summary>

<br/>
Assert that a cookie with a partial name and partial value exists
<br/><br/>

```gherkin
Then a cookie with a name containing "user" and a value containing "admin" should exist

```

</details>

<details>
  <summary><code>@Then a cookie with the name :name should not exist</code></summary>

<br/>
Assert that a cookie does not exist
<br/><br/>

```gherkin
Then a cookie with name "old_session" should not exist

```

</details>

<details>
  <summary><code>@Then a cookie with the name :name and the value :value should not exist</code></summary>

<br/>
Assert that a cookie with a specific value does not exist
<br/><br/>

```gherkin
Then a cookie with the name "language" and the value "fr" should not exist

```

</details>

<details>
  <summary><code>@Then a cookie with the name :name and a value containing :partial_value should not exist</code></summary>

<br/>
Assert that a cookie with a value containing a partial value does not exist
<br/><br/>

```gherkin
Then a cookie with the name "preferences" and a value containing "lightmode" should not exist

```

</details>

<details>
  <summary><code>@Then a cookie with a name containing :partial_name should not exist</code></summary>

<br/>
Assert that a cookie with a partial name does not exist
<br/><br/>

```gherkin
Then a cookie with a name containing "old" should not exist

```

</details>

<details>
  <summary><code>@Then a cookie with a name containing :partial_name and the value :value should not exist</code></summary>

<br/>
Assert that a cookie with a partial name and value does not exist
<br/><br/>

```gherkin
Then a cookie with a name containing "user" and the value "guest" should not exist

```

</details>

<details>
  <summary><code>@Then a cookie with a name containing :partial_name and a value containing :partial_value should not exist</code></summary>

<br/>
Assert that a cookie with a partial name and partial value does not exist
<br/><br/>

```gherkin
Then a cookie with a name containing "user" and a value containing "guest" should not exist

```

</details>

## DateTrait

[Source](mdc:src/DateTrait.php), [Example](mdc:tests/behat/features/date.feature)

>  Convert relative date expressions into timestamps or formatted dates.
>  <br/><br/>
>  Supports values and tables.
>  <br/><br/>
>  Possible formats:
>  - `[relative:OFFSET]`
>  - `[relative:OFFSET#FORMAT]`
>
>  with:
>  - `OFFSET`: any format that can be parsed by `strtotime()`.
>  - `FORMAT`: `date()` format for additional processing.
>
>  Examples:
>  - `[relative:-1 day]` converted to `1893456000`
>  - `[relative:-1 day#Y-m-d]` converted to `2017-11-5`


## ElementTrait

[Source](mdc:src/ElementTrait.php), [Example](mdc:tests/behat/features/element.feature)

>  Interact with HTML elements using CSS selectors and DOM attributes.
>  - Assert element visibility, attribute values, and viewport positioning.
>  - Execute JavaScript-based interactions with element state verification.
>  - Handle confirmation dialogs and scrolling operations.


<details>
  <summary><code>@Given I accept all confirmation dialogs</code></summary>

<br/>
Accept confirmation dialogs appearing on the page
<br/><br/>

```gherkin
Given I accept all confirmation dialogs

```

</details>

<details>
  <summary><code>@Given I do not accept any confirmation dialogs</code></summary>

<br/>
Do not accept confirmation dialogs appearing on the page
<br/><br/>

```gherkin
Given I do not accept any confirmation dialogs

```

</details>

<details>
  <summary><code>@When I click on the element :selector</code></summary>

<br/>
Click on the element defined by the selector
<br/><br/>

```gherkin
When I click on the element ".button"

```

</details>

<details>
  <summary><code>@When I trigger the JS event :event on the element :selector</code></summary>

<br/>
When I trigger the JS event :event on the element :selector
<br/><br/>

```gherkin
When I trigger the JS event "click" on the element "#submit-button"

```

</details>

<details>
  <summary><code>@When I scroll to the element :selector</code></summary>

<br/>
Scroll to an element with ID
<br/><br/>

```gherkin
When I scroll to the element "#footer"

```

</details>

<details>
  <summary><code>@Then the element :selector with the attribute :attribute and the value :value should exist</code></summary>

<br/>
Assert an element with selector and attribute with a value exists
<br/><br/>

```gherkin
Then the element "#main-content" with the attribute "class" and the value "content-wrapper" should exist

```

</details>

<details>
  <summary><code>@Then the element :selector with the attribute :attribute and the value containing :value should exist</code></summary>

<br/>
Assert an element with selector and attribute containing a value exists
<br/><br/>

```gherkin
Then the element "#main-content" with the attribute "class" and the value containing "content" should exist

```

</details>

<details>
  <summary><code>@Then the element :selector with the attribute :attribute and the value :value should not exist</code></summary>

<br/>
Assert an element with selector and attribute with a value exists
<br/><br/>

```gherkin
Then the element "#main-content" with the attribute "class" and the value "hidden" should not exist

```

</details>

<details>
  <summary><code>@Then the element :selector with the attribute :attribute and the value containing :value should not exist</code></summary>

<br/>
Assert an element with selector and attribute containing a value does not exist
<br/><br/>

```gherkin
Then the element "#main-content" with the attribute "class" and the value containing "hidden" should not exist

```

</details>

<details>
  <summary><code>@Then the element :selector should be at the top of the viewport</code></summary>

<br/>
Assert the element :selector should be at the top of the viewport
<br/><br/>

```gherkin
Then the element "#header" should be at the top of the viewport

```

</details>

<details>
  <summary><code>@Then the element :selector should be displayed</code></summary>

<br/>
Assert that element with specified CSS is visible on page
<br/><br/>

```gherkin
Then the element ".alert-success" should be displayed

```

</details>

<details>
  <summary><code>@Then the element :selector should not be displayed</code></summary>

<br/>
Assert that element with specified CSS is not visible on page
<br/><br/>

```gherkin
Then the element ".error-message" should not be displayed

```

</details>

<details>
  <summary><code>@Then the element :selector should be displayed within a viewport</code></summary>

<br/>
Assert that element with specified CSS is displayed within a viewport
<br/><br/>

```gherkin
Then the element ".hero-banner" should be displayed within a viewport

```

</details>

<details>
  <summary><code>@Then the element :selector should be displayed within a viewport with a top offset of :number pixels</code></summary>

<br/>
Assert that element with specified CSS is displayed within a viewport with a top offset
<br/><br/>

```gherkin
Then the element ".sticky-header" should be displayed within a viewport with a top offset of 50 pixels

```

</details>

<details>
  <summary><code>@Then the element :selector should not be displayed within a viewport with a top offset of :number pixels</code></summary>

<br/>
Assert that element with specified CSS is not displayed within a viewport with a top offset
<br/><br/>

```gherkin
Then the element ".below-fold-content" should not be displayed within a viewport with a top offset of 0 pixels

```

</details>

<details>
  <summary><code>@Then the element :selector should not be displayed within a viewport</code></summary>

<br/>
Assert that element with specified CSS is visually hidden on page
<br/><br/>

```gherkin
Then the element ".visually-hidden" should not be displayed within a viewport

```

</details>

## FileDownloadTrait

[Source](mdc:src/FileDownloadTrait.php), [Example](mdc:tests/behat/features/file_download.feature)

>  Test file download functionality with content verification.
>  - Download files through links and URLs with session cookie handling.
>  - Verify file names, content, and extracted archives.
>  - Set up download directories and handle file cleanup.
>
>  Skip processing with tags: `@behat-steps-skip:fileDownloadBeforeScenario` or
>  `@behat-steps-skip:fileDownloadAfterScenario`
>  <br/><br/>
>  Special tags:
>  - `@download` - enable download handling


<details>
  <summary><code>@When I download the file from the URL :url</code></summary>

<br/>
Download a file from the specified URL
<br/><br/>

```gherkin
When I download the file from the URL "/sites/default/files/document.pdf"
When I download the file from the URL "https://example.com/files/report.xlsx"

```

</details>

<details>
  <summary><code>@When I download the file from the link :link</code></summary>

<br/>
Download the file from the specified HTML link
<br/><br/>

```gherkin
When I download the file from the link "Download PDF"
When I download the file from the link "Get Report"

```

</details>

<details>
  <summary><code>@Then the downloaded file should contain:</code></summary>

<br/>
Assert the contents of the download file
<br/><br/>

```gherkin
Then the downloaded file should contain:
"""
Financial Report 2023
"""

```

</details>

<details>
  <summary><code>@Then the downloaded file name should be :name</code></summary>

<br/>
Assert the file name of the downloaded file
<br/><br/>

```gherkin
Then the downloaded file name should be "report.pdf"

```

</details>

<details>
  <summary><code>@Then the downloaded file name should contain :name</code></summary>

<br/>
Assert the downloaded file name contains a specific string
<br/><br/>

```gherkin
Then the downloaded file name should contain "report"

```

</details>

<details>
  <summary><code>@Then the downloaded file should be a zip archive containing the files named:</code></summary>

<br/>
Assert the downloaded file should be a zip archive containing specific files
<br/><br/>

```gherkin
Then the downloaded file should be a zip archive containing the files named:
| document.pdf |
| image.jpg    |
| data.csv     |

```

</details>

<details>
  <summary><code>@Then the downloaded file should be a zip archive containing the files partially named:</code></summary>

<br/>
Assert the downloaded file should be a zip archive containing files with partial names
<br/><br/>

```gherkin
Then the downloaded file should be a zip archive containing the files partially named:
| report |
| data   |
| image  |

```

</details>

<details>
  <summary><code>@Then the downloaded file should be a zip archive not containing the files partially named:</code></summary>

<br/>
Assert the downloaded file is a zip archive not containing files with partial names
<br/><br/>

```gherkin
Then the downloaded file should be a zip archive not containing the files partially named:
| confidential |
| private      |
| draft        |

```

</details>

## KeyboardTrait

[Source](mdc:src/KeyboardTrait.php), [Example](mdc:tests/behat/features/keyboard.feature)

>  Simulate keyboard interactions in Drupal browser testing.
>  - Trigger key press events including special keys and key combinations.
>  - Assert keyboard navigation and shortcut functionality.
>  - Support for targeted key presses on specific page elements.


<details>
  <summary><code>@When I press the key :key</code></summary>

<br/>
Press a single keyboard key
<br/><br/>

```gherkin
When I press the key "a"
When I press the key "tab"

```

</details>

<details>
  <summary><code>@When I press the key :key on the element :selector</code></summary>

<br/>
Press a single keyboard key on the element
<br/><br/>

```gherkin
When I press the key "a" on the element "#edit-title"
When I press the key "tab" on the element "#edit-title"

```

</details>

<details>
  <summary><code>@When I press the keys :keys</code></summary>

<br/>
Press multiple keyboard keys
<br/><br/>

```gherkin
When I press the keys "abc"

```

</details>

<details>
  <summary><code>@When I press the keys :keys on the element :selector</code></summary>

<br/>
Press multiple keyboard keys on the element
<br/><br/>

```gherkin
When I press the keys "abc" on the element "#edit-title"

```

</details>

## LinkTrait

[Source](mdc:src/LinkTrait.php), [Example](mdc:tests/behat/features/link.feature)

>  Verify link elements with attribute and content assertions.
>  - Find links by title, URL, text content, and class attributes.
>  - Test link existence, visibility, and destination accuracy.
>  - Assert absolute and relative link paths.


<details>
  <summary><code>@When I click on the link with the title :title</code></summary>

<br/>
Click on the link with a title
<br/><br/>

```gherkin
When I click on the link with the title "Return to site content"

```

</details>

<details>
  <summary><code>@Then the link :link with the href :href should exist</code></summary>

<br/>
Assert a link with a href exists
<br/><br/>

```gherkin
Then the link "About us" with the href "/about-us" should exist
Then the link "About us" with the href "/about*" should exist

```

</details>

<details>
  <summary><code>@Then the link :link with the href :href within the element :selector should exist</code></summary>

<br/>
Assert link with a href exists within an element
<br/><br/>

```gherkin
Then the link "About us" with the href "/about-us" within the element ".main-nav" should exist
Then the link "About us" with the href "/about*" within the element ".main-nav" should exist

```

</details>

<details>
  <summary><code>@Then the link :link with the href :href should not exist</code></summary>

<br/>
Assert link with a href does not exist
<br/><br/>

```gherkin
Then the link "About us" with the href "/about-us" should not exist
Then the link "About us" with the href "/about*" should not exist

```

</details>

<details>
  <summary><code>@Then the link :link with the href :href within the element :selector should not exist</code></summary>

<br/>
Assert link with a href does not exist within an element
<br/><br/>

```gherkin
Then the link "About us" with the href "/about-us" within the element ".main-nav" should not exist
Then the link "About us" with the href "/about*" within the element ".main-nav" should not exist

```

</details>

<details>
  <summary><code>@Then the link with the title :title should exist</code></summary>

<br/>
Assert that a link with a title exists
<br/><br/>

```gherkin
Then the link with the title "Return to site content" should exist

```

</details>

<details>
  <summary><code>@Then the link with the title :title should not exist</code></summary>

<br/>
Assert that a link with a title does not exist
<br/><br/>

```gherkin
Then the link with the title "Some non-existing title" should not exist

```

</details>

<details>
  <summary><code>@Then the link :link should be an absolute link</code></summary>

<br/>
Assert that the link with a text is absolute
<br/><br/>

```gherkin
Then the link "my-link-title" should be an absolute link

```

</details>

<details>
  <summary><code>@Then the link :link should not be an absolute link</code></summary>

<br/>
Assert that the link is not an absolute
<br/><br/>

```gherkin
Then the link "Return to site content" should not be an absolute link

```

</details>

## PathTrait

[Source](mdc:src/PathTrait.php), [Example](mdc:tests/behat/features/path.feature)

>  Navigate and verify paths with URL validation.
>  - Assert current page location with front page special handling.
>  - Configure basic authentication for protected path access.


<details>
  <summary><code>@Given the basic authentication with the username :username and the password :password</code></summary>

<br/>
Set basic authentication for the current session
<br/><br/>

```gherkin
Given the basic authentication with the username "myusername" and the password "mypassword"

```

</details>

<details>
  <summary><code>@Then the path should be :path</code></summary>

<br/>
Assert that the current page is a specified path
<br/><br/>

```gherkin
Then the path should be "/about-us"
Then the path should be "<front>"

```

</details>

<details>
  <summary><code>@Then the path should not be :path</code></summary>

<br/>
Assert that the current page is not a specified path
<br/><br/>

```gherkin
Then the path should not be "/about-us"
Then the path should not be "<front>"

```

</details>

## ResponseTrait

[Source](mdc:src/ResponseTrait.php), [Example](mdc:tests/behat/features/response.feature)

>  Verify HTTP responses with status code and header checks.
>  - Assert HTTP header presence and values.


<details>
  <summary><code>@Then the response should contain the header :header_name</code></summary>

<br/>
Assert that a response contains a header with specified name
<br/><br/>

```gherkin
Then the response should contain the header "Connection"

```

</details>

<details>
  <summary><code>@Then the response should not contain the header :header_name</code></summary>

<br/>
Assert that a response does not contain a header with a specified name
<br/><br/>

```gherkin
Then the response should not contain the header "Connection"

```

</details>

<details>
  <summary><code>@Then the response header :header_name should contain the value :header_value</code></summary>

<br/>
Assert that a response contains a header with a specified name and value
<br/><br/>

```gherkin
Then the response header "Connection" should contain the value "Keep-Alive"

```

</details>

<details>
  <summary><code>@Then the response header :header_name should not contain the value :header_value</code></summary>

<br/>
Assert a response does not contain a header with a specified name and value
<br/><br/>

```gherkin
Then the response header "Connection" should not contain the value "Keep-Alive"

```

</details>

## WaitTrait

[Source](mdc:src/WaitTrait.php), [Example](mdc:tests/behat/features/wait.feature)

>  Wait for a period of time or for AJAX to finish.


<details>
  <summary><code>@When I wait for :seconds second(s)</code></summary>

<br/>
Wait for a specified number of seconds
<br/><br/>

```gherkin
When I wait for 5 seconds
When I wait for 1 second

```

</details>

<details>
  <summary><code>@When I wait for :seconds second(s) for AJAX to finish</code></summary>

<br/>
Wait for the AJAX calls to finish
<br/><br/>

```gherkin
When I wait for 5 seconds for AJAX to finish
When I wait for 1 second for AJAX to finish

```

</details>



## Drupal\BigPipeTrait

[Source](mdc:src/Drupal/BigPipeTrait.php), [Example](mdc:tests/behat/features/drupal_big_pipe.feature)

>  Bypass Drupal BigPipe when rendering pages.
>  <br/><br/>
>  Activated by adding `@big_pipe` tag to the scenario.
>  <br/><br/>
>  Skip processing with tags: `@behat-steps-skip:bigPipeBeforeScenario` or
>  `@behat-steps-skip:bigPipeBeforeStep`.


## Drupal\BlockTrait

[Source](mdc:src/Drupal/BlockTrait.php), [Example](mdc:tests/behat/features/drupal_block.feature)

>  Manage Drupal blocks.
>  - Create and configure blocks with custom visibility conditions.
>  - Place blocks in regions and verify their rendering in the page.
>  - Automatically clean up created blocks after scenario completion.
>
>  Skip processing with tag: `@behat-steps-skip:blockAfterScenario`


<details>
  <summary><code>@Given the instance of :admin_label block exists with the following configuration:</code></summary>

<br/>
Create a block instance
<br/><br/>

```gherkin
Given the instance of "My block" block exists with the following configuration:
 | label         | My block |
 | label_display | 1        |
 | region        | content  |
 | status        | 1        |

```

</details>

<details>
  <summary><code>@Given the block :label has the following configuration:</code></summary>

<br/>
Configure an existing block identified by label
<br/><br/>

```gherkin
Given the block "My block" has the following configuration:
| label_display | 1       |
| region        | content |
| status        | 1       |

```

</details>

<details>
  <summary><code>@Given the block :label does not exist</code></summary>

<br/>
Remove a block specified by label
<br/><br/>

```gherkin
Given the block "My block" does not exist

```

</details>

<details>
  <summary><code>@Given the block :label is enabled</code></summary>

<br/>
Enable a block specified by label
<br/><br/>

```gherkin
Given the block "My block" is enabled

```

</details>

<details>
  <summary><code>@Given the block :label is disabled</code></summary>

<br/>
Disable a block specified by label
<br/><br/>

```gherkin
Given the block "My block" is disabled

```

</details>

<details>
  <summary><code>@Given the block :label has the following :condition condition configuration:</code></summary>

<br/>
Set a visibility condition for a block
<br/><br/>

```gherkin
Given the block "My block" has the following "request_path" condition configuration:
| pages  | /node/1\r\n/about |
| negate | 0                 |

```

</details>

<details>
  <summary><code>@Given the block :label has the :condition condition removed</code></summary>

<br/>
Remove a visibility condition from the specified block
<br/><br/>

```gherkin
Given the block "My block" has the "request_path" condition removed

```

</details>

<details>
  <summary><code>@Then the block :label should exist</code></summary>

<br/>
Assert that a block with the specified label exists
<br/><br/>

```gherkin
Then the block "My block" should exist

```

</details>

<details>
  <summary><code>@Then the block :label should not exist</code></summary>

<br/>
Assert that a block with the specified label does not exist
<br/><br/>

```gherkin
Then the block "My block" should not exist

```

</details>

<details>
  <summary><code>@Then the block :label should exist in the :region region</code></summary>

<br/>
Assert that a block with the specified label exists in a region
<br/><br/>

```gherkin
Then the block "My block" should exist in the "content" region

```

</details>

<details>
  <summary><code>@Then the block :label should not exist in the :region region</code></summary>

<br/>
Assert that a block with the specified label does not exist in a region
<br/><br/>

```gherkin
Then the block "My block" should not exist in the "content" region

```

</details>

## Drupal\ContentBlockTrait

[Source](mdc:src/Drupal/ContentBlockTrait.php), [Example](mdc:tests/behat/features/drupal_content_block.feature)

>  Manage Drupal content blocks.
>  - Define reusable custom block content with structured field data.
>  - Create, edit, and verify block_content entities by type and description.
>  - Automatically clean up created entities after scenario completion.
>
>  Skip processing with tag: `@behat-steps-skip:contentBlockAfterScenario`


<details>
  <summary><code>@Given the following :type content blocks do not exist:</code></summary>

<br/>
Remove content blocks of a specified type with the given descriptions
<br/><br/>

```gherkin
Given the following "basic" content blocks do not exist:
| [TEST] Footer Block  |
| [TEST] Contact Form  |

```

</details>

<details>
  <summary><code>@Given the following :type content blocks exist:</code></summary>

<br/>
Create content blocks of the specified type with the given field values
<br/><br/>

```gherkin
Given the following "basic" content blocks exist:
| info                  | status | body                   | created           |
| [TEST] Footer Contact | 1      | Call us at 555-1234    | 2023-01-17 8:00am |
| [TEST] Copyright      | 1      | © 2023 Example Company | 2023-01-18 9:00am |

```

</details>

<details>
  <summary><code>@When I edit the :type content block with the description :description</code></summary>

<br/>
Navigate to the edit page for a specified content block
<br/><br/>

```gherkin
When I edit the "basic" content block with the description "[TEST] Footer Block"

```

</details>

<details>
  <summary><code>@Then the content block type :type should exist</code></summary>

<br/>
Assert that a content block type exists
<br/><br/>

```gherkin
Then the content block type "Search" should exist

```

</details>

## Drupal\ContentTrait

[Source](mdc:src/Drupal/ContentTrait.php), [Example](mdc:tests/behat/features/drupal_content.feature)

>  Manage Drupal content with workflow and moderation support.
>  - Create, find, and manipulate nodes with structured field data.
>  - Navigate to node pages by title and manage editorial workflows.
>  - Support content moderation transitions and scheduled publishing.


<details>
  <summary><code>@Given the content type :content_type does not exist</code></summary>

<br/>
Delete content type
<br/><br/>

```gherkin
Given the content type "article" does not exist

```

</details>

<details>
  <summary><code>@Given the following :content_type content does not exist:</code></summary>

<br/>
Remove content defined by provided properties
<br/><br/>

```gherkin
Given the following "article" content does not exist:
  | title                |
  | Test article         |
  | Another test article |

```

</details>

<details>
  <summary><code>@When I visit the :content_type content page with the title :title</code></summary>

<br/>
Visit a page of a type with a specified title
<br/><br/>

```gherkin
When I visit the "article" content page with the title "Test article"

```

</details>

<details>
  <summary><code>@When I visit the :content_type content edit page with the title :title</code></summary>

<br/>
Visit an edit page of a type with a specified title
<br/><br/>

```gherkin
When I visit the "article" content edit page with the title "Test article"

```

</details>

<details>
  <summary><code>@When I visit the :content_type content delete page with the title :title</code></summary>

<br/>
Visit a delete page of a type with a specified title
<br/><br/>

```gherkin
When I visit the "article" content delete page with the title "Test article"

```

</details>

<details>
  <summary><code>@When I visit the :content_type content scheduled transitions page with the title :title</code></summary>

<br/>
Visit a scheduled transitions page of a type with a specified title
<br/><br/>

```gherkin
When I visit the "article" content scheduled transitions page with the title "Test article"

```

</details>

<details>
  <summary><code>@When I change the moderation state of the :content_type content with the title :title to the :new_state state</code></summary>

<br/>
Change moderation state of a content with the specified title
<br/><br/>

```gherkin
When I change the moderation state of the "article" content with the title "Test article" to the "published" state

```

</details>

## Drupal\DraggableviewsTrait

[Source](mdc:src/Drupal/DraggableviewsTrait.php), [Example](mdc:tests/behat/features/drupal_draggableviews.feature)

>  Order items in the Drupal Draggable Views.


<details>
  <summary><code>@When I save the draggable views items of the view :view_id and the display :views_display_id for the :bundle content in the following order:</code></summary>

<br/>
Save order of the Draggable Order items
<br/><br/>

```gherkin
When I save the draggable views items of the view "draggableviews_demo" and the display "page_1" for the "article" content in the following order:
  | First Article  |
  | Second Article |
  | Third Article  |

```

</details>

## Drupal\EckTrait

[Source](mdc:src/Drupal/EckTrait.php), [Example](mdc:tests/behat/features/drupal_eck.feature)

>  Manage Drupal ECK entities with custom type and bundle creation.
>  - Create structured ECK entities with defined field values.
>  - Assert entity type registration and visit entity pages.
>  - Automatically clean up created entities after scenario completion.
>
>  Skip processing with tag: `@behat-steps-skip:eckAfterScenario`


<details>
  <summary><code>@Given the following eck :bundle :entity_type entities exist:</code></summary>

<br/>
Create eck entities
<br/><br/>

```gherkin
Given the following eck "contact" "contact_type" entities exist:
| title  | field_marine_animal     | field_fish_type | ... |
| Snook  | Fish                    | Marine fish     | 10  |
| ...    | ...                     | ...             | ... |

```

</details>

<details>
  <summary><code>@Given the following eck :bundle :entity_type entities do not exist:</code></summary>

<br/>
Remove custom entities by field
<br/><br/>

```gherkin
Given the following eck "contact" "contact_type" entities do not exist:
| field        | value           |
| field_a      | Entity label    |

```

</details>

<details>
  <summary><code>@When I visit eck :bundle :entity_type entity with the title :title</code></summary>

<br/>
Navigate to view entity page with specified type and title
<br/><br/>

```gherkin
When I visit eck "contact" "contact_type" entity with the title "Test contact"

```

</details>

<details>
  <summary><code>@When I edit eck :bundle :entity_type entity with the title :title</code></summary>

<br/>
Navigate to edit eck entity page with specified type and title
<br/><br/>

```gherkin
When I edit eck "contact" "contact_type" entity with the title "Test contact"

```

</details>

## Drupal\EmailTrait

[Source](mdc:src/Drupal/EmailTrait.php), [Example](mdc:tests/behat/features/drupal_email.feature)

>  Test Drupal email functionality with content verification.
>  - Capture and examine outgoing emails with header and body validation.
>  - Follow links and test attachments within email content.
>  - Configure mail handler systems for proper test isolation.
>
>  Skip processing with tags: `@behat-steps-skip:emailBeforeScenario` or
>  `@behat-steps-skip:emailAfterScenario`
>  <br/><br/>
>  Special tags:
>  - `@email` - enable email tracking using a default handler
>  - `@email:{type}` - enable email tracking using a `{type}` handler
>  - `@debug` (enable detailed logs)


<details>
  <summary><code>@When I clear the test email system queue</code></summary>

<br/>
Clear test email system queue
<br/><br/>

```gherkin
When I clear the test email system queue

```

</details>

<details>
  <summary><code>@When I follow link number :link_number in the email with the subject :subject</code></summary>

<br/>
Follow a specific link number in an email with the given subject
<br/><br/>

```gherkin
When I follow link number "1" in the email with the subject "Account Verification"

```

</details>

<details>
  <summary><code>@When I follow link number :link_number in the email with the subject containing :subject</code></summary>

<br/>
Follow a specific link number in an email whose subject contains the given substring
<br/><br/>

```gherkin
When I follow link number "1" in the email with the subject containing "Verification"

```

</details>

<details>
  <summary><code>@When I enable the test email system</code></summary>

<br/>
Enable the test email system
<br/><br/>

```gherkin
When I enable the test email system

```

</details>

<details>
  <summary><code>@When I disable the test email system</code></summary>

<br/>
Disable test email system
<br/><br/>

```gherkin
When I disable the test email system

```

</details>

<details>
  <summary><code>@Then an email should be sent to the :address</code></summary>

<br/>
Assert that an email should be sent to an address
<br/><br/>

```gherkin
Then an email should be sent to the "user@example.com"

```

</details>

<details>
  <summary><code>@Then no emails should have been sent</code></summary>

<br/>
Assert that no email messages should be sent
<br/><br/>

```gherkin
Then no emails should have been sent

```

</details>

<details>
  <summary><code>@Then no emails should have been sent to the :address</code></summary>

<br/>
Assert that no email messages should be sent to a specified address
<br/><br/>

```gherkin
Then no emails should have been sent to the "user@example.com"

```

</details>

<details>
  <summary><code>@Then the email header :header should contain:</code></summary>

<br/>
Assert that the email message header should contain specified content
<br/><br/>

```gherkin
Then the email header "Subject" should contain:
"""
Account details
"""

```

</details>

<details>
  <summary><code>@Then the email header :header should exactly be:</code></summary>

<br/>
Assert that the email message header should be the exact specified content
<br/><br/>

```gherkin
Then the email header "Subject" should exactly be:
"""
Your Account Details
"""

```

</details>

<details>
  <summary><code>@Then an email should be sent to the address :address with the content:</code></summary>

<br/>
Assert that an email should be sent to an address with the exact content in the body
<br/><br/>

```gherkin
Then an email should be sent to the address "user@example.com" with the content:
"""
Welcome to our site!
Click the link below to verify your account.
"""

```

</details>

<details>
  <summary><code>@Then an email should be sent to the address :address with the content containing:</code></summary>

<br/>
Assert that an email should be sent to an address with the body containing specific content
<br/><br/>

```gherkin
Then an email should be sent to the address "user@example.com" with the content containing:
"""
verification link
"""

```

</details>

<details>
  <summary><code>@Then an email should be sent to the address :address with the content not containing:</code></summary>

<br/>
Assert that an email should be sent to an address with the body not containing specific content
<br/><br/>

```gherkin
Then an email should be sent to the address "user@example.com" with the content not containing:
"""
password
"""

```

</details>

<details>
  <summary><code>@Then an email should not be sent to the address :address with the content:</code></summary>

<br/>
Assert that an email should not be sent to an address with the exact content in the body
<br/><br/>

```gherkin
Then an email should not be sent to the address "wrong@example.com" with the content:
"""
Welcome to our site!
"""

```

</details>

<details>
  <summary><code>@Then an email should not be sent to the address :address with the content containing:</code></summary>

<br/>
Assert that an email should not be sent to an address with the body containing specific content
<br/><br/>

```gherkin
Then an email should not be sent to the address "wrong@example.com" with the content containing:
"""
verification link
"""

```

</details>

<details>
  <summary><code>@Then the email field :field should contain:</code></summary>

<br/>
Assert that the email field should contain a value
<br/><br/>

```gherkin
Then the email field "body" should contain:
"""
Please verify your account
"""

```

</details>

<details>
  <summary><code>@Then the email field :field should be:</code></summary>

<br/>
Assert that the email field should exactly match a value
<br/><br/>

```gherkin
Then the email field "subject" should be:
"""
Account Verification
"""

```

</details>

<details>
  <summary><code>@Then the email field :field should not contain:</code></summary>

<br/>
Assert that the email field should not contain a value
<br/><br/>

```gherkin
Then the email field "body" should not contain:
"""
password
"""

```

</details>

<details>
  <summary><code>@Then the email field :field should not be:</code></summary>

<br/>
Assert that the email field should not exactly match a value
<br/><br/>

```gherkin
Then the email field "subject" should not be:
"""
Password Reset
"""

```

</details>

<details>
  <summary><code>@Then the file :file_name should be attached to the email with the subject :subject</code></summary>

<br/>
Assert that a file is attached to an email message with specified subject
<br/><br/>

```gherkin
Then the file "document.pdf" should be attached to the email with the subject "Your document"

```

</details>

<details>
  <summary><code>@Then the file :file_name should be attached to the email with the subject containing :subject</code></summary>

<br/>
Assert that a file is attached to an email message with a subject containing the specified substring
<br/><br/>

```gherkin
Then the file "report.xlsx" should be attached to the email with the subject containing "Monthly Report"

```

</details>

## Drupal\FieldTrait

[Source](mdc:src/Drupal/FieldTrait.php), [Example](mdc:tests/behat/features/drupal_field.feature)

>  Manipulate Drupal form fields and verify widget functionality.
>  - Set field values for various input types including selects and WYSIWYG.
>  - Assert field existence, state, and selected options.
>  - Support for specialized widgets like color pickers and rich text editors.


<details>
  <summary><code>@When I fill in the color field :field with the value :value</code></summary>

<br/>
Fill value for color field
<br/><br/>

```gherkin
When I fill in the color field "#edit-text-color" with the value "#3366FF"

```

</details>

<details>
  <summary><code>@When I fill in the WYSIWYG field :field with the :value</code></summary>

<br/>
Set value for WYSIWYG field
<br/><br/>

```gherkin
When I fill in the WYSIWYG field "edit-body-0-value" with the "<p>This is a <strong>formatted</strong> paragraph.</p>"

```

</details>

<details>
  <summary><code>@Then the field :name should exist</code></summary>

<br/>
Assert that field exists on the page using id,name,label or value
<br/><br/>

```gherkin
Then the field "Body" should exist
Then the field "field_body" should exist

```

</details>

<details>
  <summary><code>@Then the field :name should not exist</code></summary>

<br/>
Assert that field does not exist on the page using id,name,label or value
<br/><br/>

```gherkin
Then the field "Body" should not exist
Then the field "field_body" should not exist

```

</details>

<details>
  <summary><code>@Then the field :name should be :enabled_or_disabled</code></summary>

<br/>
Assert whether the field has a state
<br/><br/>

```gherkin
Then the field "Body" should be "disabled"
Then the field "field_body" should be "disabled"
Then the field "Tags" should be "enabled"
Then the field "field_tags" should be "not enabled"

```

</details>

<details>
  <summary><code>@Then the color field :field should have the value :value</code></summary>

<br/>
Assert that a color field has a value
<br/><br/>

```gherkin
Then the color field "#edit-background-color" should have the value "#FF5733"

```

</details>

<details>
  <summary><code>@Then the option :option should exist within the select element :selector</code></summary>

<br/>
Assert that a select has an option
<br/><br/>

```gherkin
Then the option "Administrator" should exist within the select element "edit-roles"

```

</details>

<details>
  <summary><code>@Then the option :option should not exist within the select element :selector</code></summary>

<br/>
Assert that a select does not have an option
<br/><br/>

```gherkin
Then the option "Guest" should not exist within the select element "edit-roles"

```

</details>

<details>
  <summary><code>@Then the option :option should be selected within the select element :selector</code></summary>

<br/>
Assert that a select option is selected
<br/><br/>

```gherkin
Then the option "Administrator" should be selected within the select element "edit-roles"

```

</details>

<details>
  <summary><code>@Then the option :option should not be selected within the select element :selector</code></summary>

<br/>
Assert that a select option is not selected
<br/><br/>

```gherkin
Then the option "Editor" should not be selected within the select element "edit-roles"

```

</details>

## Drupal\FileTrait

[Source](mdc:src/Drupal/FileTrait.php), [Example](mdc:tests/behat/features/drupal_file.feature)

>  Manage Drupal file entities with upload and storage operations.
>  - Create managed and unmanaged files with specific URIs and content.
>  - Verify file existence, content, and proper storage locations.
>  - Set up file system directories and clean up created files.
>
>  Skip processing with tags: `@behat-steps-skip:fileBeforeScenario` or
>  `@behat-steps-skip:fileAfterScenario`


<details>
  <summary><code>@Given the following managed files:</code></summary>

<br/>
Create managed files with properties provided in the table
<br/><br/>

```gherkin
Given the following managed files:
| path         | uri                    | status |
| document.pdf | public://document.pdf  | 1      |
| image.jpg    | public://images/pic.jpg| 1      |

```

</details>

<details>
  <summary><code>@Given the following managed files do not exist:</code></summary>

<br/>
Delete managed files defined by provided properties/fields
<br/><br/>

```gherkin
Given no managed files:
| filename      |
| myfile.jpg    |
| otherfile.jpg |
 Given no managed files:
 | uri                    |
 | public://myfile.jpg    |
 | public://otherfile.jpg |

```

</details>

<details>
  <summary><code>@Given the unmanaged file at the URI :uri exists</code></summary>

<br/>
Create an unmanaged file
<br/><br/>

```gherkin
Given the unmanaged file at the URI "public://sample.txt" exists

```

</details>

<details>
  <summary><code>@Given the unmanaged file at the URI :uri exists with :content</code></summary>

<br/>
Create an unmanaged file with specified content
<br/><br/>

```gherkin
Given the unmanaged file at the URI "public://data.txt" exists with "Sample content"

```

</details>

<details>
  <summary><code>@Then an unmanaged file at the URI :uri should exist</code></summary>

<br/>
Assert that an unmanaged file with specified URI exists
<br/><br/>

```gherkin
Then an unmanaged file at the URI "public://sample.txt" should exist

```

</details>

<details>
  <summary><code>@Then an unmanaged file at the URI :uri should not exist</code></summary>

<br/>
Assert that an unmanaged file with specified URI does not exist
<br/><br/>

```gherkin
Then an unmanaged file at the URI "public://temp.txt" should not exist

```

</details>

<details>
  <summary><code>@Then an unmanaged file at the URI :uri should contain :content</code></summary>

<br/>
Assert that an unmanaged file exists and has specified content
<br/><br/>

```gherkin
Then an unmanaged file at the URI "public://config.txt" should contain "debug=true"

```

</details>

<details>
  <summary><code>@Then an unmanaged file at the URI :uri should not contain :content</code></summary>

<br/>
Assert that an unmanaged file exists and does not have specified content
<br/><br/>

```gherkin
Then an unmanaged file at the URI "public://config.txt" should not contain "debug=false"

```

</details>

## Drupal\MediaTrait

[Source](mdc:src/Drupal/MediaTrait.php), [Example](mdc:tests/behat/features/drupal_media.feature)

>  Manage Drupal media entities with type-specific field handling.
>  - Create structured media items with proper file reference handling.
>  - Assert media browser functionality and edit media entity fields.
>  - Support for multiple media types with field value expansion handling.
>  - Automatically clean up created entities after scenario completion.
>
>  Skip processing with tag: `@behat-steps-skip:mediaAfterScenario`


<details>
  <summary><code>@Given :media_type media type does not exist</code></summary>

<br/>
Remove media type
<br/><br/>

```gherkin
Given "video" media type does not exist

```

</details>

<details>
  <summary><code>@Given the following media :media_type exist:</code></summary>

<br/>
Create media of a given type
<br/><br/>

```gherkin
Given "video" media:
| name     | field1   | field2 | field3           |
| My media | file.jpg | value  | value            |
| ...      | ...      | ...    | ...              |

```

</details>

<details>
  <summary><code>@Given the following media :media_type do not exist:</code></summary>

<br/>
Remove media defined by provided properties
<br/><br/>

```gherkin
Given the following media "image" do not exist:
| name               |
| Media item         |
| Another media item |

```

</details>

<details>
  <summary><code>@When I edit the media :media_type with the name :name</code></summary>

<br/>
Navigate to edit media with specified type and name
<br/><br/>

```gherkin
When I edit "document" media "Test document"

```

</details>

## Drupal\MenuTrait

[Source](mdc:src/Drupal/MenuTrait.php), [Example](mdc:tests/behat/features/drupal_menu.feature)

>  Manage Drupal menu systems and menu link rendering.
>  - Assert menu items by label, path, and containment hierarchy.
>  - Assert menu link visibility and active states in different regions.
>  - Create and manage menu hierarchies with parent-child relationships.
>  - Automatically clean up created menu links after scenario completion.
>
>  Skip processing with tag: `@behat-steps-skip:menuAfterScenario`


<details>
  <summary><code>@Given the menu :menu_name does not exist</code></summary>

<br/>
Remove a single menu by its label if it exists
<br/><br/>

```gherkin
Given the menu "Test Menu" does not exist

```

</details>

<details>
  <summary><code>@Given the following menus:</code></summary>

<br/>
Create a menu if one does not exist
<br/><br/>

```gherkin
Given the following menus:
| label            | description                    |
| Footer Menu     | Links displayed in the footer  |
| Secondary Menu  | Secondary navigation menu      |

```

</details>

<details>
  <summary><code>@Given the following menu links do not exist in the menu :menu_name:</code></summary>

<br/>
Remove menu links by title
<br/><br/>

```gherkin
Given the following menu links do not exist in the menu "Main navigation":
| About Us     |
| Contact      |

```

</details>

<details>
  <summary><code>@Given the following menu links exist in the menu :menu_name :</code></summary>

<br/>
Create menu links
<br/><br/>

```gherkin
Given the following menu links exist in the menu "Main navigation":
| title           | enabled | uri                     | parent       |
| Products        | 1       | /products               |              |
| Latest Products | 1       | /products/latest        | Products     |

```

</details>

## Drupal\MetatagTrait

[Source](mdc:src/Drupal/MetatagTrait.php), [Example](mdc:tests/behat/features/drupal_metatag.feature)

>  Assert `<meta>` tags in page markup.
>  - Assert presence and content of meta tags with proper attribute handling.


## Drupal\OverrideTrait

[Source](mdc:src/Drupal/OverrideTrait.php), [Example](mdc:tests/behat/features/drupal_override.feature)

>  Override Drupal Extension behaviors.
>  - Automated entity deletion before creation to avoid duplicates.
>  - Improved user authentication handling for anonymous users.
>
>  Use with caution: depending on your version of Drupal Extension, PHP and
>  Composer, the step definition string (/^Given etc.../) may need to be defined
>  for these overrides. If you encounter errors about missing or duplicated
>  step definitions, do not include this trait and rather copy the contents of
>  this file into your feature context file and copy the step definition strings
>  from the Drupal Extension.


## Drupal\ParagraphsTrait

[Source](mdc:src/Drupal/ParagraphsTrait.php), [Example](mdc:tests/behat/features/drupal_paragraphs.feature)

>  Manage Drupal paragraphs entities with structured field data.
>  - Create paragraph items with type-specific field values.
>  - Test nested paragraph structures and reference field handling.
>  - Attach paragraphs to various entity types with parent-child relationships.
>  - Automatically clean up created paragraph items after scenario completion.
>
>  Skip processing with tag: `@behat-steps-skip:paragraphsAfterScenario`


<details>
  <summary><code>@Given the following fields for the paragraph :paragraph_type exist in the field :parent_field within the :parent_bundle :parent_entity_type identified by the field :parent_lookup_field and the value :parent_lookup_value:</code></summary>

<br/>
Create a paragraph of the given type with fields within an existing entity
<br/><br/>

```gherkin
Given the following fields for the paragraph "text" exist in the field "field_component" within the "landing_page" "node" identified by the field "title" and the value "My landing page":
| field_paragraph_title           | My paragraph title   |
| field_paragraph_longtext:value  | My paragraph message |
| field_paragraph_longtext:format | full_html            |
| ...                             | ...                  |

```

</details>

## Drupal\SearchApiTrait

[Source](mdc:src/Drupal/SearchApiTrait.php), [Example](mdc:tests/behat/features/drupal_search_api.feature)

>  Assert Drupal Search API with index and query operations.
>  - Add content to an index
>  - Run indexing for a specific number of items.


<details>
  <summary><code>@When I add the :content_type content with the title :title to the search index</code></summary>

<br/>
Index a node of a specific content type with a specific title
<br/><br/>

```gherkin
When I add the "article" content with the title "Test Article" to the search index

```

</details>

<details>
  <summary><code>@When I run search indexing for :count item(s)</code></summary>

<br/>
Run indexing for a specific number of items
<br/><br/>

```gherkin
When I run search indexing for 5 items
When I run search indexing for 1 item

```

</details>

## Drupal\TaxonomyTrait

[Source](mdc:src/Drupal/TaxonomyTrait.php), [Example](mdc:tests/behat/features/drupal_taxonomy.feature)

>  Manage Drupal taxonomy terms with vocabulary organization.
>  - Create term vocabulary structures using field values.
>  - Navigate to term pages
>  - Verify vocabulary configurations.


<details>
  <summary><code>@Given the following :vocabulary_machine_name vocabulary terms do not exist:</code></summary>

<br/>
Remove terms from a specified vocabulary
<br/><br/>

```gherkin
Given the following "fruits" vocabulary terms do not exist:
  | Apple |
  | Pear  |

```

</details>

<details>
  <summary><code>@When I visit the :vocabulary_machine_name vocabulary :term_name term page</code></summary>

<br/>
Visit specified vocabulary term page
<br/><br/>

```gherkin
When I visit the "fruits" vocabulary "Apple" term page

```

</details>

<details>
  <summary><code>@When I edit the :vocabulary_machine_name vocabulary :term_name term page</code></summary>

<br/>
Edit specified vocabulary term page
<br/><br/>

```gherkin
When I edit the "fruits" vocabulary "Apple" term page

```

</details>

<details>
  <summary><code>@Then the vocabulary :machine_name with the name :name should exist</code></summary>

<br/>
Assert that a vocabulary with a specific name exists
<br/><br/>

```gherkin
Then the vocabulary "topics" with the name "Topics" should exist

```

</details>

<details>
  <summary><code>@Then the vocabulary :machine_name should not exist</code></summary>

<br/>
Assert that a vocabulary with a specific name does not exist
<br/><br/>

```gherkin
Then the vocabulary "topics" should not exist

```

</details>

<details>
  <summary><code>@Then the taxonomy term :term_name from the vocabulary :vocabulary_machine_name should exist</code></summary>

<br/>
Assert that a taxonomy term exist by name
<br/><br/>

```gherkin
Then the taxonomy term "Apple" from the vocabulary "Fruits" should exist

```

</details>

<details>
  <summary><code>@Then the taxonomy term :term_name from the vocabulary :vocabulary_machine_name should not exist</code></summary>

<br/>
Assert that a taxonomy term does not exist by name
<br/><br/>

```gherkin
Then the taxonomy term "Apple" from the vocabulary "Fruits" should not exist

```

</details>

## Drupal\TestmodeTrait

[Source](mdc:src/Drupal/TestmodeTrait.php), [Example](mdc:tests/behat/features/drupal_testmode.feature)

>  Configure Drupal Testmode module for controlled testing scenarios.
>  <br/><br/>
>  Skip processing with tags: `@behat-steps-skip:testmodeBeforeScenario` and
>  `@behat-steps-skip:testmodeAfterScenario`.
>  <br/><br/>
>  Special tags:
>  - `@testmode` - enable for scenario


## Drupal\UserTrait

[Source](mdc:src/Drupal/UserTrait.php), [Example](mdc:tests/behat/features/drupal_user.feature)

>  Manage Drupal users with role and permission assignments.
>  - Create user accounts
>  - Create user roles
>  - Visit user profile pages for editing and deletion.
>  - Assert user roles and permissions.
>  - Assert user account status (active/inactive).


<details>
  <summary><code>@Given the following users do not exist:</code></summary>

<br/>
Remove users specified in a table
<br/><br/>

```gherkin
Given the following users do not exist:
 | name |
 | John |
 | Jane |
 Given the following users do not exist:
  | mail             |
  | john@example.com |
  | jane@example.com |

```

</details>

<details>
  <summary><code>@Given the password for the user :name is :password</code></summary>

<br/>
Set a password for a user
<br/><br/>

```gherkin
Given the password for the user "John" is "password"

```

</details>

<details>
  <summary><code>@Given the last access time for the user :name is :datetime</code></summary>

<br/>
Set last access time for a user
<br/><br/>

```gherkin
Given the last access time for the user "John" is "Friday, 22 November 2024 13:46:14"
Given the last access time for the user "John" is "1732319174"

```

</details>

<details>
  <summary><code>@Given the last login time for the user :name is :datetime</code></summary>

<br/>
Set last login time for a user
<br/><br/>

```gherkin
Given the last login time for the user "John" is "Friday, 22 November 2024 13:46:14"
Given the last login time for the user "John" is "1732319174"

```

</details>

<details>
  <summary><code>@Given the role :role_name with the permissions :permissions</code></summary>

<br/>
Create a single role with specified permissions
<br/><br/>

```gherkin
Given the role "Content Manager" with the permissions "access content, create article content, edit any article content"

```

</details>

<details>
  <summary><code>@Given the following roles:</code></summary>

<br/>
Create multiple roles from the specified table
<br/><br/>

```gherkin
Given the following roles:
| name              | permissions                              |
| Content Editor    | access content, create article content   |
| Content Approver  | access content, edit any article content |

```

</details>

<details>
  <summary><code>@When I visit :name user profile page</code></summary>

<br/>
Visit the profile page of the specified user
<br/><br/>

```gherkin
When I visit "John" user profile page

```

</details>

<details>
  <summary><code>@When I visit my own user profile page</code></summary>

<br/>
Visit the profile page of the current user
<br/><br/>

```gherkin
When I visit my own user profile page

```

</details>

<details>
  <summary><code>@When I visit :name user profile edit page</code></summary>

<br/>
Visit the profile edit page of the specified user
<br/><br/>

```gherkin
When I visit "John" user profile edit page

```

</details>

<details>
  <summary><code>@When I visit my own user profile edit page</code></summary>

<br/>
Visit the profile edit page of the current user
<br/><br/>

```gherkin
When I visit my own user profile edit page

```

</details>

<details>
  <summary><code>@When I visit :name user profile delete page</code></summary>

<br/>
Visit the profile delete page of the specified user
<br/><br/>

```gherkin
When I visit "John" user profile delete page

```

</details>

<details>
  <summary><code>@When I visit my own user profile delete page</code></summary>

<br/>
Visit the profile delete page of the current user
<br/><br/>

```gherkin
When I visit my own user profile delete page

```

</details>

<details>
  <summary><code>@Then the user :name should have the role(s) :roles assigned</code></summary>

<br/>
Assert that a user has roles assigned
<br/><br/>

```gherkin
Then the user "John" should have the roles "administrator, editor" assigned

```

</details>

<details>
  <summary><code>@Then the user :name should not have the role(s) :roles assigned</code></summary>

<br/>
Assert that a user does not have roles assigned
<br/><br/>

```gherkin
Then the user "John" should not have the roles "administrator, editor" assigned

```

</details>

<details>
  <summary><code>@Then the user :name should be blocked</code></summary>

<br/>
Assert that a user is blocked
<br/><br/>

```gherkin
Then the user "John" should be blocked

```

</details>

<details>
  <summary><code>@Then the user :name should not be blocked</code></summary>

<br/>
Assert that a user is not blocked
<br/><br/>

```gherkin
Then the user "John" should not be blocked

```

</details>

## Drupal\WatchdogTrait

[Source](mdc:src/Drupal/WatchdogTrait.php), [Example](mdc:tests/behat/features/drupal_watchdog.feature)

>  Assert Drupal does not trigger PHP errors during scenarios using Watchdog.
>  - Check for Watchdog messages after scenario completion.
>  - Optionally check only for specific message types.
>  - Optionally skip error checking for specific scenarios.
>
>  Skip processing with tags: `@behat-steps-skip:watchdogSetScenario` or
>  `@behat-steps-skip:watchdogAfterScenario`
>  <br/><br/>
>  Special tags:
>  - `@watchdog:{type}` - limit watchdog messages to specific types.
>  - `@error` - add to scenarios that are expected to trigger an error.

## Steps Format Guidelines
- **General Guidelines**:
  - Use tuple format instead of regular expressions
  - Use descriptive placeholder names
  - Use `the following` for tabled content
  - Use `with` for properties: `Then the link with the title :title should exist`
  - Avoid optional words like `(the|a)`
  - Omit unnecessary suffixes like `on the page`
  - Method names should begin with the trait name: `userAssertHasRoles()`

- **Given Steps**:
  - Define test prerequisites
  - Use words like `exists` or `have`
  - Avoid using `should` or `should not`
  - Avoid using `Given I`

- **When Steps**:
  - Describe an action with an action verb
  - Use the format `When I <verb>`

- **Then Steps**:
  - Specify assertions and expectations
  - Use `should` and `should not` for assertions
  - Start with the entity being asserted
  - Avoid using `Then I`
  - Methods should include the `Assert` prefix

## Common Behat Step Patterns
- Block assertions:
  - `I should see the block with label "..."`
  - `I should see the block with label "..." in the region "..."`

- Content block operations:
  - `the content block type "..." should exist`
  - `the following "..." content blocks exist:`
  - `I edit the "..." content block with the description "..."`

- Email testing:
  - `I enable the test email system`
  - `I clear the test email system queue`
  - `an email should be sent to the "..."`

## Skipping Before Scenario Hooks
Some traits provide `beforeScenario` hook implementations that can be disabled by adding `behat-steps-skip:METHOD_NAME` tag to your test.

Example: To skip `beforeScenario` hook from `ElementTrait`, add `@behat-steps-skip:ElementTrait` tag to the feature.

## Code Style Conventions
- Code is written using Drupal coding standards
- Local variables and method arguments: `snake_case`
- Method names and class properties: `camelCase`
