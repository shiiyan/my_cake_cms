<h1><?= h($article->title) ?></h1>
<p><?= h($article->body) ?></p>
<p><b>Tags:</b> <?= h($article->tag_string) ?></b></p>
<p><b>Author:</b> <?= h($article->user->email) ?></b></p>
<p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></p>
