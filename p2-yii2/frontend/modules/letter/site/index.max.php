<?php
/**
 * @frontend/modules/letter/site/index.php
 *
 * @author Pedro Plowman
 * @copyright Copyright (c) 2024 Steppe West
 * @link https://steppewest.com/
 * @license MIT
 */

/**
 * Main view for displaying letter content.
 *
 * @var yii\web\View $this
 * @var array $bodyContent Contains the processed content items
 * @var string|null $faqLink FAQ link generated from body content
 */
$bodyContent = $this->params['bodyContent'];

/*
var_dump($this->params['rawContent']);
var_dump($this->params['rawItem']);
var_dump($this->params['htmlContent']);
var_dump($bodyContent);
var_dump($this->params['assetUrl']);
var_dump($this->params['basePath']);
var_dump($this->params['basename']);
var_dump($this->params['frontend']);
 */
?>
<section class="py-1">
	<?= $this->render('@app/modules/letter/layouts/languages.php') ?>

	<div class="container my-4">
		<!-- Loop through body content and alternate layouts -->
		<?php foreach ($bodyContent as $index => $contentItem): ?>
			<?php
				// Choose the layout based on index (alternate left and right)
				$layoutFile = $index % 2 === 0
					? '@app/modules/letter/layouts/letter-row-left.php'
					: '@app/modules/letter/layouts/letter-row-right.php';
			?>
			<?= $this->render($layoutFile, [
				'contentItem' => $contentItem['content'],
				'image' => $contentItem['image'],
			]) ?>
		<?php endforeach; ?>

			<!-- accordion -->
			<div class="row align-items-center mt-4">
				<div class="col-md-8 offset-md-2">
					<!-- outer accordion -->
					<div class="accordion" id="outerFAQaccordion">
						<div class="accordion-item">
							<h1 class="accordion-header">
								<button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#outerFAQcollapse" aria-expanded="false" aria-controls="outerFAQcollapse">
								Frequently Asked Questions
								</button>
							</h1>
							<div id="outerFAQcollapse" class="accordion-collapse collapse" data-bs-parent="#outerFAQaccordion">
								<div class="accordion-body p-0">
									<!-- inner accordion -->
									<div class="accordion accordion-flush" id="innerFAQaccordion">
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem01" aria-expanded="false" aria-controls="faqItem01">
												What is Steppe West?
												</button>
											</h2>
											<div id="faqItem01" class="accordion-collapse collapse show" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													Steppe West is a multimedia platform dedicated to celebrating and sharing the cultures of Central Asia, Turkic, and Mongol peoples through stories, videos, and other creative content for an English speaking audience.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem02" aria-expanded="false" aria-controls="faqItem02">
												Why do you call it Steppe West?
												</button>
											</h2>
											<div id="faqItem02" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													The name Steppe West was chosen to symbolise the mission of bringing the cultures of the vast Central Asian steppes to Western audiences. It reflects the journey of sharing the rich and diverse traditions, stories, and everyday life of the steppe peoples with people like myself in the Western world.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem03" aria-expanded="false" aria-controls="faqItem03">
												How is Steppe West different from other cultural platforms?
												</button>
											</h2>
											<div id="faqItem03" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													Unlike many social media content creators, I see myself as a curator and publisher. Steppe West isn’t about my voice—it’s about yours. My goal is to present your stories, perspectives, and culture in a way that reflects your world authentically, not filtered through my personal views.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem04" aria-expanded="false" aria-controls="faqItem04">
												Are you a foreign agent?
												</button>
											</h2>
											<div id="faqItem04" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													While I am indeed a foreigner, my role is to act as your cultural representative to the English speaking world. My goal is to promote your culture authentically and respectfully, without interference.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem05" aria-expanded="false" aria-controls="faqItem05">
												What do you mean by Central Asian, Turkic, and Mongol?
												</button>
											</h2>
											<div id="faqItem05" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													These terms refer to content created by people from the regions they represent, such as Kazakhstan, Kyrgyzstan, Mongolia, Turkey, and beyond. It’s important to recognise that these countries are home to many ethnicities and nationalities, each contributing to their unique cultural fabric. Whether you identify with the majority group or belong to one of the many smaller communities, your stories, perspectives, and experiences are equally valued and welcome on Steppe West.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem06" aria-expanded="false" aria-controls="faqItem06">
												What kind of collaboration do you seek?
												</button>
											</h2>
											<div id="faqItem06" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													I seek content that I can adapt and share with English speaking audiences through Steppe West. Whether you’re a creator, storyteller, or cultural ambassador, I’d love to work with you. Proper attribution and links back to your original work are always guaranteed.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem07" aria-expanded="false" aria-controls="faqItem07">
												What types of media do you accept?
												</button>
											</h2>
											<div id="faqItem07" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													We accept various media types, including text, images, videos, and music. Platforms include Substack, Facebook, Instagram, YouTube, TikTok, Threads, and Bluesky. (Steppe West is also on X/Twitter but has made it a lower priority due to the platform’s increasingly challenging environment.)
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem08" aria-expanded="false" aria-controls="faqItem08">
												What kind of content is suitable?
												</button>
											</h2>
											<div id="faqItem08" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													Any content that you believe would interest or inform English speakers. This includes cultural stories, day-to-day life experiences, and even political or sensitive stories that you feel should be told. Any attempt to define this further would simply be a list of examples, and even then, it might exclude something unique or important. What you might consider mundane could be fascinating to someone outside your world, so don’t hesitate to share whatever feels meaningful to you.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem09" aria-expanded="false" aria-controls="faqItem09">
												Why not just share existing posts?
												</button>
											</h2>
											<div id="faqItem09" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													While I already share many posts, existing content often isn’t suitable for English speaking audiences. By working together, we can create tailored content that is more accessible and engaging for an English speaking audience.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem10" aria-expanded="false" aria-controls="faqItem10">
												What changes might be needed for the content?
												</button>
											</h2>
											<div id="faqItem10" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													That depends on the content. In many cases, a direct translation or an English description will suffice. For videos, adding English captions or subtitles often works best. Ideally, original subtitles can be removed for clarity. Sometimes, additional context—such as historical background or cultural explanations—may be needed for an English speaking audience. I will take primary responsibility for adapting the content in consultation with you, ensuring it remains true to its original meaning and intent.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem11" aria-expanded="false" aria-controls="faqItem11">
												Can content in multiple languages be featured?
												</button>
											</h2>
											<div id="faqItem11" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													Absolutely. Language accessibility is a cornerstone of Steppe West. That’s why these pages are available in multiple languages. Some content might be especially impactful when presented in a multilingual format, and elements of the original language—such as audio—will always be retained when appropriate.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem12" aria-expanded="false" aria-controls="faqItem12">
												What do you gain from this project?
												</button>
											</h2>
											<div id="faqItem12" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													Currently, it’s a labour of love with no financial gain. The goal is to foster a global appreciation of these rich cultures, create opportunities for collaboration, and build a vibrant, engaged community. As Steppe West grows, business opportunities may emerge, such as partnerships, sponsorships, or monetising certain aspects of the platform. However, Steppe West will always remain a not-for-profit enterprise, with any financial gains reinvested into its mission or shared fairly among contributors.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem13" aria-expanded="false" aria-controls="faqItem13">
												Do you pay for the content?
												</button>
											</h2>
											<div id="faqItem13" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													Not at the moment. Steppe West is a volunteer-driven project, but I aim to share future financial gains fairly among contributors as the platform grows.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem14" aria-expanded="false" aria-controls="faqItem14">
												What is the long-term vision for Steppe West?
												</button>
											</h2>
											<div id="faqItem14" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													My first goal is to build a platform and brand that authentically represents you and your culture in English. As the following grows, I hope to explore business opportunities, particularly those that create new markets for your work and talents. I also aspire to contribute to education, especially for girls, by providing access to technology. This vision begins modestly—like providing a laptop and phone to help girls in a Tashkent family—but it’s a step toward a broader goal of empowering communities through education and opportunity.
												</div>
											</div>
										</div>
										<div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#faqItem15" aria-expanded="false" aria-controls="faqItem15">
												How do I get involved?
												</button>
											</h2>
											<div id="faqItem15" class="accordion-collapse collapse" data-bs-parent="#innerFAQaccordion">
												<div class="accordion-body">
													Reach out with your content, questions, or suggestions. Let’s collaborate to share your culture with a wider audience. Contact me by email, messaging app, or through any of the Steppe West social media accounts.
												</div>
											</div>
										</div>
									</div>
									<!-- / inner accordion -->
								</div>
							</div>
						</div>
					</div>
					<!-- / outer accordion -->
				</div>
			</div>
			<!-- /accordion -->

	</div>

	<?= $this->render('@app/modules/letter/layouts/letter-foot.php') ?>
</section>
