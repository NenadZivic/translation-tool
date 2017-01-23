# translation-tool
A tool for multimodal translation

Currently includes only two dummy examples needed for basic navigation through the page.

Workflow for translation is designed in a simplistic way, as follows:

- A translation lands at the home page, enters only his/her email address as an identifier (it actually doens't have to be valid, but if they want to get paid, they should enter a valid email)
- Then the translator is directed to the first example, and goes through examples sequentially. At each Next/Previous, a sync with the database is ran.
- When the translator is finished, he/she just closes the tab, and everything is saved - no need to save manually :)

Database structure is simple as well - there are two tables:
- example (id, source, target)- contains training data with source and target text
- translation (id, email, translation, comment) - contains each translation from each translator

Images are saved in /www/images/ folder, as img_{id of image from example table}.

A corpus needs to be added, along with a script to fill the database properly.
