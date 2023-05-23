<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <div class="space-y-10 divide-y divide-gray-900/10">
        <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
          <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">New note</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Enter the detail of your note here.</p>
          </div>

          <form method="post" action="/notes" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl
          md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
              <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                  <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                  <div class="mt-2">
                    <div
                      class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                      <input
                        type="text"
                        name="title"
                        id="title"
                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                        placeholder="My New Note"
                        value="<?= $_POST['title'] ?? "" ?>">
                    </div>
                  </div>
                </div>

                <div class="col-span-full">
                  <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Body</label>
                  <div class="mt-2">
                    <textarea id="body" name="body" rows="3" class="block w-full rounded-md border-0 py-1.5 px-1.5
                    text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2
                    focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $_POST['body'] ?? "" ?></textarea>
                      <?php if (isset($errors['title'])) : ?>
                        <p class="text-red-500 text-xs mt-2"><?= $errors['title'] ?></p>
                      <?php endif; ?>
                      <?php if (isset($errors['body'])) : ?>
                        <p class="text-red-500 text-xs mt-2"><?= $errors['body'] ?></p>
                      <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
              <a href="/notes" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
              hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
              focus-visible:outline-indigo-600">Cancel</a>
              <button type="submit"
                      class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

<?php require base_path('views/partials/foot.php') ?>