<?php

  use GuzzleHttp\Client;

  class TelegramBot {
    protected $token = '1063863518:AAFgvV-CVTDsuVq_D1IclhkoyXIMpQeLhTk';
    protected $updateId;

    // Query builder method
    protected function query($method, $params = []) {
      $url = 'https://api.telegram.org/bot' . $this->token . '/' . $method;

      if (!empty($params)) {
        $url .= '?' . http_build_query($params);
      }

      // Instantiate new client object from GuzzleHttp package
      $client = new Client(['base_uri' => $url]);

      // Make request
      $result = $client->request('GET');
      $json_result = json_decode($result->getBody());
      return $json_result;
    }

    public function getUpdates() {
      /*$args = ['offset' => $this->updateId + 1];

      $response = $this->query('getUpdates', $args);

      if (!empty($response->result)) {
        $this->updateId = $response->result[count($response->result) - 1]->update_id;
      }
*/

      $response = $this->query('getUpdates', ['offset' => $this->updateId + 1]);

      if (!empty($response->result)) {
        $this->updateId = $response->result[count($response->result) - 1]->update_id;
      }
      return $response->result;
    }

    // méthode temporaire à des fins de développement
    public function getAllMessages() {
      $response = $this->query('getUpdates');
      return $response->result;
    }

    public function getLatestMessageDetails() {
      $all_messages = $this->getAllMessages(); // obtient tous les messages
      $last_message = $all_messages[count($all_messages) - 1]; // obtient les derniers messages
      $last_message_id = $last_message->message->message_id; // obtient l'id du dernier message
      $last_message_chat_id = $last_message->message->chat->id; // obtient le dernier id de chat du dernier message
      $last_message_text = $last_message->message->text; // obtient le texte du dernier message
      $details = ['chat_id' => $last_message_chat_id, 'message_id' => $last_message_id, 'text' => $last_message_text];
      return $details;
    }

    public function sendMessage($chat_id, $text) {
      $args = ['text' => $text, 'chat_id' => $chat_id];
      $response = $this->query('sendMessage', $args);
      return $response;
    }

    public function deleteMessage($chat_id = 0, $message_id = 0) {
      if (!empty($chat_id) || !empty($message_id)) {
        $args = ['chat_id' => $chat_id, 'message_id' => $message_id];
      } else {
        $details = $this->getLatestMessageDetails();
        $args = ['chat_id' => $details['chat_id'], 'message_id' => $details['message_id']];
      }

      $response = $this->query('deleteMessage', $args);
      return $response;
    }
  }