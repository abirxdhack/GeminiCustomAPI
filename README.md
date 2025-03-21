# Custom Gemini API Setup

This repository provides a simple setup for interacting with the Gemini AI using PHP. The API enables you to send user input to Gemini and receive AI-generated responses.

## Overview

This API allows you to send a prompt to the Gemini API and get a response back in a JSON format. It integrates the Gemini API using the provided PHP script and is perfect for building chatbots, AI-powered websites, or custom applications.

## Features

- Send a user prompt to Gemini API.
- Get AI-generated responses.
- Limit responses to 3000 characters.
- Developer details included in the API response for attribution.

## Prerequisites

Before you begin, ensure you have the following:

- A **Gemini API key**. You can obtain it from the [Gemini API](https://generativelanguage.googleapis.com/).
- A PHP-enabled server with **CURL** support enabled.

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/abirxdhack/GeminiCustomAPI.git
cd GeminiCustomAPI
```

### 2. Configuration

In the `gem.php` file, you need to configure your Gemini API key.

```php
define('GEMINI_API_KEY', 'YourGeminiAPIKeyHere');
```

Replace `'YourGeminiAPIKeyHere'` with your actual Gemini API key.

### 3. Set up the PHP server

If you're using a local PHP server, you can start it with the following command:

```bash
php -S localhost:8000
```

Alternatively, upload the files to your web server.

### 4. Test the API

Once the server is running, you can test the API by sending a `GET` request to the following URL:

```
http://localhost:8000/gem.php?prompt=hi
```

The response will look like:

```json
{
    "response": "Hello! How can I assist you today?",
    "developer": "Developer @abirxdhackz"
}
```

If you don't provide a prompt, you'll get an error response:

```json
{
    "error": "Please provide a prompt using the 'prompt' query parameter.",
    "developer": "Developer @abirxdhackz"
}
```

## How It Works

1. **User Input:** The user provides input via the `prompt` query parameter.
2. **Request to Gemini API:** The input is sent to the Gemini API via a POST request with the necessary configurations (temperature, topP, etc.).
3. **AI Response:** The AI's response is parsed, and the first 3000 characters are returned as the output.
4. **Error Handling:** If no prompt is provided, an error response is returned with a message explaining what went wrong.

## Developer

- **[Abir Arafat Chawdhury](t.me/abirxdhackz)** - Creator and Developer
