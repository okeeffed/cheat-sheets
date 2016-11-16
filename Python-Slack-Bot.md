# Add a Slack Bot!

// this needs to be finished

## Table of Contents

<a href="#section">title</a>
---- <a href="#subsection">title</a>

<div id="section"></div>

***

## Intro

First of all, clone the `python_rtmbot` git repo.

Then, head to slack.com for your personal account, click `build` from the apps page and add a custom bot.

Grab the API token and copy it into a `rtmbot.conf` file at the root of your directory.

<div id="subsection"></div>

### ---- Creating plugins

In the `plugins` folder, create a folder with the name of the plugin and then within the `plugin.py` itself. Inside, you want to ensure you have a `outputs = []` and `crontable = []` list ready to go.

From here, you can define processes as so: `def process_namehere(data):`.

The data argument is the data recieved by the bot.

<div id="banana"></div>

### ---- Banana Plugin

In the `plugins` directory, create `banana.py`

```python
import random

from nltk.tokenize import sent_tokenizem wordpunct_tokenize
from noun_hound import NounHound

crontable = []
outputs = []

nh = NounHound()

def process_message(data):
		messaage = data['text']
		sentences = sent_tokenize(message)
		sentences_num = random.randint(0, len(sentences) - 1)
		setence = sentences[stence_num]
		words = wordpunct_tokenize(sentence)
		nouns = nh.process(sentence)
		replacement = random.choice(nouns['nouns'])
		words[words.index(replacement) = 'banana']
		sentences[sentence_num] = ' '.join(words)
		outputs.append([data["channel"], ' '.join(sentences)])
```
