# Custom Command: Session Summary

## Command Usage
`/session-summary [notes]`

Use optional `notes` to highlight areas you want analysed.

You are an AI assistant tasked with analyzing a coding session and suggesting improvements to the AGENTS.md file. Your goal is to enhance the efficiency of tool calls and reduce future token usage by identifying and addressing problems that occurred during the session.

First, review the current content of the AGENTS.md file:

<agents_md_content>
the current AGENTS.md content
</agents_md_content>

Now, examine the session history:

<session_history>
the full session history transcript
</session_history>

Analyze the session history and generate improvement suggestions for the AGENTS.md file. Focus on the following areas:
1. Failed tool calls
2. Repeated attempts to use non-existing tools or options
3. Incorrect decisions leading to wasted tokens
4. Attempts to write to files outside permitted directories
5. Any other issues that resulted in inefficient token usage

When creating suggestions, keep them small and concise. Each suggestion should directly address a specific problem identified in the session history.

Format your suggestions as follows:
1. Start each suggestion with "Suggestion: " followed by a brief description of the improvement.
2. Provide a short explanation of why this improvement is necessary, referencing the specific issue in the session history.
3. If applicable, include the exact text to be added to or modified in the AGENTS.md file.

Present your suggestions in a numbered list, allowing the user to choose which ones to implement. For example:

1. Suggestion: Add permitted directory paths
   Explanation: Multiple attempts were made to write to unauthorized directories, wasting tokens.
   Addition to AGENTS.md: "Permitted write directories: /project/data, /project/output"

2. Suggestion: Update available tool list
   Explanation: Several calls were made to non-existent tools, causing errors and token waste.
   Modification in AGENTS.md: Replace "analyze_data" with "process_data" in the tools section.

After presenting the suggestions, include the following message:
"Please select the suggestions you would like to implement by entering their corresponding numbers (e.g., '1, 3, 4' or 'all'). I will then proceed with updating the AGENTS.md file accordingly."

Once the user has made their selection, update the AGENTS.md file content with the chosen improvements. If the user selects "all", implement all suggestions.

Your final output should be structured as follows:
<analysis_results>
[Numbered list of suggestions]
[Selection prompt for the user]
</analysis_results>

<updated_agents_md>
[Updated content of AGENTS.md after implementing selected suggestions]
</updated_agents_md>

Remember, your output should only include the content within the <analysis_results> and <updated_agents_md> tags. Do not include any additional commentary or explanations outside of these tags.
