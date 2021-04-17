<?php

?>

Tailwind UI
Now updated for Tailwind CSS v2.0! Learn more →

Components
Documentation

Application UI
Data Display
Description Lists
Left-aligned in card
Preview
Code
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
	<div class="px-4 py-5 sm:px-6">
		<h3 class="text-lg leading-6 font-medium text-gray-900">
			Applicant Information
		</h3>
		<p class="mt-1 max-w-2xl text-sm text-gray-500">
			Personal details and application.
		</p>
	</div>
	<div class="border-t border-gray-200 px-4 py-5 sm:p-0">
		<dl class="sm:divide-y sm:divide-gray-200">
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Full name
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Margot Foster
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Application for
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Backend Developer
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Email address
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					margotfoster@example.com
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Salary expectation
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					$120,000
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					About
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Attachments
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					<ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<!-- Heroicon name: solid/paper-clip -->
								<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
								</svg>
								<span class="ml-2 flex-1 w-0 truncate">
                  resume_back_end_developer.pdf
                </span>
							</div>
							<div class="ml-4 flex-shrink-0">
								<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
									Download
								</a>
							</div>
						</li>
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<!-- Heroicon name: solid/paper-clip -->
								<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
								</svg>
								<span class="ml-2 flex-1 w-0 truncate">
                  coverletter_back_end_developer.pdf
                </span>
							</div>
							<div class="ml-4 flex-shrink-0">
								<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
									Download
								</a>
							</div>
						</li>
					</ul>
				</dd>
			</div>
		</dl>
	</div>
</div>


<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
	<div class="px-4 py-5 sm:px-6">
		<h3 class="text-lg leading-6 font-medium text-gray-900">
			Applicant Information
		</h3>
		<p class="mt-1 max-w-2xl text-sm text-gray-500">
			Personal details and application.
		</p>
	</div>
	<div class="border-t border-gray-200 px-4 py-5 sm:p-0">
		<dl class="sm:divide-y sm:divide-gray-200">
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Full name
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Margot Foster
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Application for
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Backend Developer
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Email address
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					margotfoster@example.com
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Salary expectation
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					$120,000
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					About
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Attachments
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					<ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<!-- Heroicon name: solid/paper-clip -->
								<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
								</svg>
								<span class="ml-2 flex-1 w-0 truncate">
                  resume_back_end_developer.pdf
                </span>
							</div>
							<div class="ml-4 flex-shrink-0">
								<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
									Download
								</a>
							</div>
						</li>
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<!-- Heroicon name: solid/paper-clip -->
								<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
								</svg>
								<span class="ml-2 flex-1 w-0 truncate">
                  coverletter_back_end_developer.pdf
                </span>
							</div>
							<div class="ml-4 flex-shrink-0">
								<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
									Download
								</a>
							</div>
						</li>
					</ul>
				</dd>
			</div>
		</dl>
	</div>
</div>
Left-aligned striped in card
Preview
Code
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
	<div class="px-4 py-5 sm:px-6">
		<h3 class="text-lg leading-6 font-medium text-gray-900">
			Applicant Information
		</h3>
		<p class="mt-1 max-w-2xl text-sm text-gray-500">
			Personal details and application.
		</p>
	</div>
	<div class="border-t border-gray-200">
		<dl>
			<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Full name
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Margot Foster
				</dd>
			</div>
			<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Application for
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Backend Developer
				</dd>
			</div>
			<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Email address
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					margotfoster@example.com
				</dd>
			</div>
			<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Salary expectation
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					$120,000
				</dd>
			</div>
			<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					About
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.
				</dd>
			</div>
			<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">
					Attachments
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					<ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<!-- Heroicon name: solid/paper-clip -->
								<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
								</svg>
								<span class="ml-2 flex-1 w-0 truncate">
                  resume_back_end_developer.pdf
                </span>
							</div>
							<div class="ml-4 flex-shrink-0">
								<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
									Download
								</a>
							</div>
						</li>
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<!-- Heroicon name: solid/paper-clip -->
								<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
								</svg>
								<span class="ml-2 flex-1 w-0 truncate">
                  coverletter_back_end_developer.pdf
                </span>
							</div>
							<div class="ml-4 flex-shrink-0">
								<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
									Download
								</a>
							</div>
						</li>
					</ul>
				</dd>
			</div>
		</dl>
	</div>
</div>



Left-aligned with inline actions
Preview
Code
<!-- This example requires Tailwind CSS v2.0+ -->
<div>
	<h3 class="text-lg leading-6 font-medium text-gray-900">
		Applicant Information
	</h3>
	<p class="mt-1 max-w-2xl text-sm text-gray-500">
		Personal details and application.
	</p>
</div>
<div class="mt-5 border-t border-gray-200">
	<dl class="divide-y divide-gray-200">
		<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
			<dt class="text-sm font-medium text-gray-500">
				Full name
			</dt>
			<dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
				<span class="flex-grow">Margot Foster</span>
				<span class="ml-4 flex-shrink-0">
          <button type="button" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Update
          </button>
        </span>
			</dd>
		</div>
		<div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">
			<dt class="text-sm font-medium text-gray-500">
				Application for
			</dt>
			<dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
				<span class="flex-grow">Backend Developer</span>
				<span class="ml-4 flex-shrink-0">
          <button type="button" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Update
          </button>
        </span>
			</dd>
		</div>
		<div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">
			<dt class="text-sm font-medium text-gray-500">
				Email address
			</dt>
			<dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
				<span class="flex-grow">margotfoster@example.com</span>
				<span class="ml-4 flex-shrink-0">
          <button type="button" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Update
          </button>
        </span>
			</dd>
		</div>
		<div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">
			<dt class="text-sm font-medium text-gray-500">
				Salary expectation
			</dt>
			<dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
				<span class="flex-grow"> $120,000</span>
				<span class="ml-4 flex-shrink-0">
          <button type="button" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Update
          </button>
        </span>
			</dd>
		</div>
		<div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">
			<dt class="text-sm font-medium text-gray-500">
				About
			</dt>
			<dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">
        <span class="flex-grow">
          Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.
        </span>
				<span class="ml-4 flex-shrink-0">
          <button type="button" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Update
          </button>
        </span>
			</dd>
		</div>
		<div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">
			<dt class="text-sm font-medium text-gray-500">
				Attachments
			</dt>
			<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
				<ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
					<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
						<div class="w-0 flex-1 flex items-center">
							<!-- Heroicon name: solid/paper-clip -->
							<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
							</svg>
							<span class="ml-2 flex-1 w-0 truncate">
                resume_back_end_developer.pdf
              </span>
						</div>
						<div class="ml-4 flex-shrink-0 flex space-x-4">
							<button type="button" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
								Update
							</button>
							<span class="text-gray-300" aria-hidden="true">|</span>
							<button type="button" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
								Remove
							</button>
						</div>
					</li>
					<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
						<div class="w-0 flex-1 flex items-center">
							<!-- Heroicon name: solid/paper-clip -->
							<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
							</svg>
							<span class="ml-2 flex-1 w-0 truncate">
                coverletter_back_end_developer.pdf
              </span>
						</div>
						<div class="ml-4 flex-shrink-0 flex space-x-4">
							<button type="button" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
								Update
							</button>
							<span class="text-gray-300" aria-hidden="true">|</span>
							<button type="button" class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
								Remove
							</button>
						</div>
					</li>
				</ul>
			</dd>
		</div>
	</dl>
</div>



Left-aligned
Preview
Code
<!-- This example requires Tailwind CSS v2.0+ -->
<div>
	<div>
		<h3 class="text-lg leading-6 font-medium text-gray-900">
			Applicant Information
		</h3>
		<p class="mt-1 max-w-2xl text-sm text-gray-500">
			Personal details and application.
		</p>
	</div>
	<div class="mt-5 border-t border-gray-200">
		<dl class="sm:divide-y sm:divide-gray-200">
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
				<dt class="text-sm font-medium text-gray-500">
					Full name
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Margot Foster
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
				<dt class="text-sm font-medium text-gray-500">
					Application for
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Backend Developer
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
				<dt class="text-sm font-medium text-gray-500">
					Email address
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					margotfoster@example.com
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
				<dt class="text-sm font-medium text-gray-500">
					Salary expectation
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					$120,000
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
				<dt class="text-sm font-medium text-gray-500">
					About
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.
				</dd>
			</div>
			<div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
				<dt class="text-sm font-medium text-gray-500">
					Attachments
				</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
					<ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<!-- Heroicon name: solid/paper-clip -->
								<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
								</svg>
								<span class="ml-2 flex-1 w-0 truncate">
                  resume_back_end_developer.pdf
                </span>
							</div>
							<div class="ml-4 flex-shrink-0">
								<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
									Download
								</a>
							</div>
						</li>
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<!-- Heroicon name: solid/paper-clip -->
								<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
								</svg>
								<span class="ml-2 flex-1 w-0 truncate">
                  coverletter_back_end_developer.pdf
                </span>
							</div>
							<div class="ml-4 flex-shrink-0">
								<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
									Download
								</a>
							</div>
						</li>
					</ul>
				</dd>
			</div>
		</dl>
	</div>
</div>



Two-column in card
Preview
Code
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
	<div class="px-4 py-5 sm:px-6">
		<h3 class="text-lg leading-6 font-medium text-gray-900">
			Applicant Information
		</h3>
		<p class="mt-1 max-w-2xl text-sm text-gray-500">
			Personal details and application.
		</p>
	</div>
	<div class="border-t border-gray-200 px-4 py-5 sm:px-6">
		<dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
			<div class="sm:col-span-1">
				<dt class="text-sm font-medium text-gray-500">
					Full name
				</dt>
				<dd class="mt-1 text-sm text-gray-900">
					Margot Foster
				</dd>
			</div>
			<div class="sm:col-span-1">
				<dt class="text-sm font-medium text-gray-500">
					Application for
				</dt>
				<dd class="mt-1 text-sm text-gray-900">
					Backend Developer
				</dd>
			</div>
			<div class="sm:col-span-1">
				<dt class="text-sm font-medium text-gray-500">
					Email address
				</dt>
				<dd class="mt-1 text-sm text-gray-900">
					margotfoster@example.com
				</dd>
			</div>
			<div class="sm:col-span-1">
				<dt class="text-sm font-medium text-gray-500">
					Salary expectation
				</dt>
				<dd class="mt-1 text-sm text-gray-900">
					$120,000
				</dd>
			</div>
			<div class="sm:col-span-2">
				<dt class="text-sm font-medium text-gray-500">
					About
				</dt>
				<dd class="mt-1 text-sm text-gray-900">
					Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.
				</dd>
			</div>
			<div class="sm:col-span-2">
				<dt class="text-sm font-medium text-gray-500">
					Attachments
				</dt>
				<dd class="mt-1 text-sm text-gray-900">
					<ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<!-- Heroicon name: solid/paper-clip -->
								<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
								</svg>
								<span class="ml-2 flex-1 w-0 truncate">
                  resume_back_end_developer.pdf
                </span>
							</div>
							<div class="ml-4 flex-shrink-0">
								<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
									Download
								</a>
							</div>
						</li>
						<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
							<div class="w-0 flex-1 flex items-center">
								<!-- Heroicon name: solid/paper-clip -->
								<svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
								</svg>
								<span class="ml-2 flex-1 w-0 truncate">
                  coverletter_back_end_developer.pdf
                </span>
							</div>
							<div class="ml-4 flex-shrink-0">
								<a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
									Download
								</a>
							</div>
						</li>
					</ul>
				</dd>
			</div>
		</dl>
	</div>
</div>





