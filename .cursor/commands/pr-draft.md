# Custom Command: PR Draft

## Command Usage
`/pr-draft <pr-notes>`

The argument `<pr-notes>` should capture highlights, testing notes, and reviewer callouts. Use it to shape the PR title and body.

You are tasked with creating a pull request (PR) for a code change. Follow these instructions carefully to generate an appropriate PR description and title.

Check if Use the user-provided arguments (if any) as contextual input was provided in a prompt. If not, stop first and ask user for any comments, assign them as Use the user-provided arguments (if any) as contextual input. Process the Use the user-provided arguments (if any) as contextual input, extract the useful information and plan how it might impact pull request creation. If none provided, proceed with the PR creation.

## Tool use

Use github cli or github mcp if available for PR creation.

## Template

First, here is the PR template that should be used as a base for the pull request description:

<pr_template>
the repository pull request template
</pr_template>

Now, let's create the pull request:

1. Extract the ticket number:
   Analyze the branch name provided: the active Git branch name
   Look for a four-digit number in the branch name, which should represent the Freshdesk ticket number. If found, use it in the next steps. If not found, make a note to ask for it later, unless Use the user-provided arguments (if any) as contextual input instruct you to skip ticket number.

2. Create the PR title:
   Format: "[#TICKET_NUMBER] [Verb in past tense] [description of the change] [full stop at the end.]"
   Example: "[#5765] Updated user authentication process."

3. Create the PR description:
   Start with the PR template provided above.
   
   For the "Freshdesk or JIRA ticket" section:
   - If you found a ticket number, add the link: https://servicedesk.salsadigital.com.au/a/tickets/TICKET_NUMBER
   - If no ticket number was found, leave a placeholder: "TODO: Add Freshdesk ticket link", However, if you were provided with instructions to skip ticket number, then ignore this line. 

   For the "Changed" section:
   - Be very descriptive about every change made.
   - Use proper markdown with headings, lists and other markdown options.
   - Ensure extra empty line is present between header and text and between list options.
   - Mention constant names, variables, and classes that were generated or updated.
   - Explain the reason for the update and what problems were solved.
   - List the items that were updated or changed.
   - Do not include lengthy code snippets.

   For the "Screenshots" section:
   - Leave it empty.

4. If any information is missing (e.g., ticket number not found in branch name), add a note at the end of the PR description listing the missing information that needs to be provided, unless custom instructions in the Use the user-provided arguments (if any) as contextual input instruct you not to do so. 

5. Final output:
   Provide the following in your response:
   a) The PR title
   b) The complete PR description
   c) Any questions or missing information that need to be addressed before submitting the PR
   d) PR link.

Remember, your final output should only include the PR title, PR description, and any questions about missing information. Do not include any of your thought process or these instructions in the output.
